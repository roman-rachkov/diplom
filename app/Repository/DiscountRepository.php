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
                    return
                        $this->getDiscountQueryFilter(Discount::CATEGORY_OTHER)
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
                    return
                        $this->getDiscountQueryFilter(
                            Discount::CATEGORY_CART,
                            $productsQty,
                            $cartCost
                        )
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
                    return $this->getDiscountQueryFilter(Discount::CATEGORY_SET)->get();
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

    public function getDiscountQueryFilter(
        string $categoryType,
        ?int $productsQty =  null,
        ?float $cartCost = null
    ): Builder
    {
        $currentTime = Carbon::now();
        return Discount::where(
            [
                ['category_type', $categoryType],
                ['is_active', 1],
                ['start_at', '<', $currentTime],
                ['end_at', '>', $currentTime],
            ])->when(!is_null($productsQty), function ($query) use ($productsQty){
                $query->where([
                    ['minimum_qty', '<=', $productsQty],
                    ['maximum_qty', '>=', $productsQty]
                ]);
            })->when(!is_null($cartCost), function ($query) use ($cartCost) {
                $query->where([
                    ['minimal_cost', '<=', $cartCost],
                    ['maximum_cost', '>=', $cartCost]
                ]);
        });
    }


    public function getAllActiveDiscount()
    {
        $itemOnPage = $this->adminSettings->get('discountsOnPage', 8);

        return Discount::whereIsActive(true)->orderBy('start_at')->paginate($itemOnPage);
    }
}