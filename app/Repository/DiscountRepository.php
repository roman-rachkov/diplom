<?php

namespace App\Repository;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class DiscountRepository implements DiscountRepositoryContract
{
    private AdminSettingsServiceContract $adminSettings;

    public function __construct(AdminSettingsServiceContract $adminSettings)
    {
        $this->adminSettings= $adminSettings;
    }

    public function getMostWeightyProductDiscount(Product $product) : null|Discount
    {
        return Cache::tags(
            [
                'discounts',
                'products',
                'categories'
            ])
            ->remember(
                'most_weighty_discount:product_id=' . $product->id,
                $this->getTtl(),
                function () use ($product) {
                    return Discount::where($this->getDiscountQueryFilter(Discount::CATEGORY_OTHER))
                        ->whereIn('id', function ($query) use ($product) {
                            $query->select('discount_id')
                                ->from('discount_groups')
                                ->whereIn('id', function ($query) use ($product) {
                                    $query->select('discount_group_id')
                                        ->from('discount_groupables')
                                        ->where(function ($query) use ($product) {
                                            $query->where([
                                                ['discount_groupable_type','=', 'App\\Models\\Product'],
                                                ['discount_groupable_id', $product->id]
                                            ]);
                                        })
                                        ->orWhere(function ($query) use ($product) {
                                            $query->where([
                                                ['discount_groupable_type','=', 'App\\Models\\Category'],
                                                ['discount_groupable_id', $product->category_id]
                                            ]);
                                        });
                                });
                        })
                        ->orderByDesc('weight')
                        ->first();
                });
    }

    public function getMostWeightyCartDiscount(int $productsQty, float $cartCost): Discount
    {
        return Cache::tags(
            [
                'discounts',
                'products',
                'categories'
            ])->remember(
                'cart_most_weight_discount',
            $this->getTtl(),
            function () use (
                $productsQty,
                $cartCost,
            ) {
                    return Discount::where(
                        $this->getDiscountQueryFilter(
                            Discount::CATEGORY_CART,
                            $productsQty,
                            $cartCost))
                        ->orderByDesc('weight')
                        ->first();
            }
        );

    }

    public function getMostWeightySetDiscount(Collection $products)
    {
        return Discount::has('discountGroups', '>', 1)
            ->where($this->getDiscountQueryFilter(
                Discount::CATEGORY_SET))
            ->get()
            //TODO: нижеследующий код перенести в сервис?
            ->transform(function ($discount) use ($products) {
                $countOfIntersected = 0;
                $discountProductIds = collect();
                foreach ($discount->discountGroups as $discountGroup) {
                    $intersectedDiscountGroupProductIds = $discountGroup
                        ->categories
                        ->reduce(
                            function($carry, $category){
                                return $carry->merge($category->products->pluck('id'));
                            },
                            collect()
                        )
                        ->merge($discountGroup->products->pluck('id'))
                        ->intersect($products->pluck('id'));
                    if ($intersectedDiscountGroupProductIds->isNotEmpty()) {
                        $discountProductIds = $discountProductIds->merge($intersectedDiscountGroupProductIds);
                        $countOfIntersected++;
                    }
                }

                if ($countOfIntersected > 1) {
                    return ['discount' => $discount->id, 'productIds' => $discountProductIds];
                }
                    return null;
            });
            //->skipWhile()
            //->sortByDesc('weight');
    }


    protected function getTtl()
    {
        return $this->adminSettings->get('discountsCacheTime', 60 * 60 * 24);
    }

    protected function getDiscountQueryFilter(
        string $category_type,
        ?int $productsQty =  null,
        ?float $cartCost = null
    ): array
    {
        $currentTime = Carbon::now();
        $queryFilter = [
            ['category_type', $category_type],
            ['is_active', 1],
            ['start_at', '<', $currentTime],
            ['end_at', '>', $currentTime],
        ];

        $queryFilter = is_null($productsQty) ?
            $queryFilter:
            array_merge(
                $queryFilter,
                [
                    ['minimum_qty', '>=', $productsQty],
                    ['maximum_qty', '>=', $productsQty]
                ]);

        return is_null($cartCost) ?
            $queryFilter :
            array_merge(
                $queryFilter,
                [
                    ['minimal_cost', '<=', $cartCost],
                    ['maximum_cost', '>=', $cartCost]
                ]);
    }

}