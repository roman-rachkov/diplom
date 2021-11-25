<?php

namespace App\Repository;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Discount;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
                        ->whereHas('discountGroups', function($query) use ($product){
                            $query->whereHas('products', function ($query) use ($product){
                                $query->where('id', $product->id);
                            })->orWhereHas('categories', function ($query) use ($product){
                               $query->whereHas('products', function ($query) use ($product){
                                   $query->where('id', $product->id);
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

    protected function getTestDiscountQueryFilter(
        Builder $query,
        string $categoryType,
        ?int $productsQty =  null,
        ?float $cartCost = null
    ): Builder
    {
        $currentTime = Carbon::now();
        $queryFilter = [
            ['category_type', $categoryType],
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
            $query->where($queryFilter) :
            $query->where(array_merge(
                $queryFilter,
                [
                    ['minimal_cost', '<=', $cartCost],
                    ['maximum_cost', '>=', $cartCost]
                ]));
    }


    public function getAllActiveDiscount()
    {
        $itemOnPage = $this->adminSettings->get('discountsOnPage', 8);

        return Discount::whereIsActive(true)->orderBy('start_at')->paginate($itemOnPage);
    }
}