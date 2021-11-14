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
        $productIds = $products->pluck('id');
        $categoryIds = $products->pluck('category_id');

        $discounts = Discount::has('discountGroups', '>', 1)
            ->where($this->getDiscountQueryFilter(
                Discount::CATEGORY_CART))
//            ->whereIn('id', function ($query) use ($productIds, $categoryIds) {
//                $query->select('discount_id')
//                    ->from('discount_groups')
//                    ->whereIn('id', function ($query) use ($productIds, $categoryIds) {
//                    $query->select('discount_group_id')
//                        ->from('discount_groupables')
//                        ->where(function ($query) use ($productIds) {
//                            $query->where('discount_groupable_type','=', 'App\\Models\\Product')
//                                ->whereIn('discount_groupable_id', $productIds);
//                        })
//                        ->orWhere(function ($query) use ($categoryIds) {
//                            $query->where('discount_groupable_type','=', 'App\\Models\\Category')
//                                ->whereIn('discount_groupable_id', $categoryIds);
//                        });
//                });
//
//            })
            ->get()
            ->transform(function ($discount) use ($products) {
                $discountProductIds = [];
                $discount->discountGroups->each(
                    function ($discountGroup) use ($products) {
                        //TODO: на каждой итерации находить пересечение
                        // id продуктов с id продуктов(через продукты и категории)
                        // и удалять из id продуктов. Если такие пересечения массивов
                        // есть как минимум на 2ух итерациях, то оставлюяем такую скидку.
                    }
                );

            });

        return $discounts;
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