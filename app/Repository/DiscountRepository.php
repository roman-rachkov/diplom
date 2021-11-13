<?php

namespace App\Repository;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
        //Коллекция продуктов
        //Product::whereIn('id', $ids)->select('id')->with('discountGroups:discount_id')->get()
        return Product::whereIn('id', $products->pluck('id'))
            ->select('id')
//            ->whereExists(function ($query) {
//                    $query->select(DB::raw(1))
//                        ->from('orders')
//                        ->whereColumn('orders.user_id', 'users.id');
//            })
            ->with(
                [
                    'discountGroups' => function($query){
                        $query->where(function ($query) {
                              $query->select('category_type')
                              ->from('discounts')
                              ->whereColumn('discounts.id', 'discount_groups.discount_id');
                            }, Discount::CATEGORY_SET)
                            ->select('id', 'discount_id')
                            ->with('discount');
//                            ->with(['discount' => function($query){
//                                $query->where('category_type', Discount::CATEGORY_SET);
//                            }]);
                    }
                ]
            )
            ->get();
//            ->filter(function ($product) {
//                return $product->discountGroups->isNotEmpty();
//            });
    }


    protected function getTtl()
    {
        return $this->adminSettings->get('discountsCacheTime', 60 * 60 * 24);
    }

}