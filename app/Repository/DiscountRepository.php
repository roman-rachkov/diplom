<?php

namespace App\Repository;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
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

                    return Product::with('discountGroups.discount')
                        ->find($product->id)
                        ->discountGroups
                        ->pluck('discount')
                        ->merge(Category::with('discountGroups.discount')
                            ->find($product->category_id)
                            ->discountGroups
                            ->pluck('discount')
                        )
                        ->unique('id')
                        ->filter(
                            function ($discount) {
                                return $discount->category_type === Discount::CATEGORY_OTHER;
                            })
                        ->sortByDesc('weight')
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
            function () use ($productsQty, $cartCost) {
                    return Discount::where([
                        ['category_type', Discount::CATEGORY_CART],
                        ['minimum_qty', '>=', $productsQty],
                        ['maximum_qty', '>=', $productsQty],
                        ['minimal_cost', '<=', $cartCost],
                        ['maximum_cost', '>=', $cartCost]
                    ])
                        ->orderByDesc('weight')
                        ->get()
                        ->first();
            }
        );

    }

    public function getMostWeightySetDiscount(Collection $products)
    {
//        return Discount::where('category_type', Discount::CATEGORY_SET)
//            ->with('discountGroups');

        $products->each(function ($item,$key) {

        });
    }


    protected function getTtl()
    {
        return $this->adminSettings->get('discountsCacheTime', 60 * 60 * 24);
    }

}