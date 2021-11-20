<?php

namespace App\Repository;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\Cache;

class DiscountRepository implements DiscountRepositoryContract
{


    public function __construct(
        private AdminSettingsServiceContract $adminSettings
    )
    {}

    public function getProductDiscount(Product $product) : ?Discount
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
                    return Discount::where(
                            $this->getDiscountQueryFilter(Discount::CATEGORY_OTHER)
                        )
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

    public function getOnCartDiscount(
        string $customerId,
        int $productsQty,
        float $cartCost
    ): ?Discount
    {
        return Cache::tags(
            [
                'discounts',
                'products',
                'categories'
            ]
        )->remember(
            $this->getCartDiscountCacheKey($customerId, 'cart_most_weight_discount'),
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

    public function getOnSetDiscounts(): EloquentCollection
    {

        return Cache::tags(
            [
                'discounts',
                'products',
                'categories'
            ]
        )->remember(
                'set_discounts',
                $this->getTtl(),
                function () {
                    return Discount::where($this->getDiscountQueryFilter(
                            Discount::CATEGORY_SET))
                        ->get();
                });
    }


    protected function getTtl()
    {
        return $this->adminSettings
            ->get('discountsCacheTime', 60 * 60 * 24);
    }

    protected function getCartDiscountCacheKey(string $customerId, string $cartDiscountName): string
    {
        return
            $cartDiscountName .
            '|customer_id=' .
            $customerId;
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
                    ['minimum_qty', '<=', $productsQty],
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

    public function getAllActiveDiscount()
    {
        $itemOnPage = $this->adminSettings->get('discountsOnPage', 8);

        return Discount::whereIsActive(true)->orderBy('start_at')->paginate($itemOnPage);
    }
}