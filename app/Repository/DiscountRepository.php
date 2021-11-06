<?php

namespace App\Repository;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class DiscountRepository implements DiscountRepositoryContract
{
    private AdminSettingsServiceContract $adminSettings;

    public function __construct(AdminSettingsServiceContract $adminSettings)
    {
        $this->adminSettings= $adminSettings;
    }

    public function getMostWeightyProductDiscount(Product $product) : Discount
    {
        $ttl = $this->adminSettings->get('discountsCacheTime', 60 * 60 * 24);

        return Cache::tags(
            [
                'discounts',
                'products',
                'categories'
            ])
            ->remember(
                'most_weighty_discount:product_id=' . $product->id,
                $ttl,
                function () use ($product) {

                    return Product::with('discountGroups.discount')
                        ->find($product->id)
                        ->discountGroups
                        ->pluck('discount')
                        ->merge(Category::with('discountGroups.discount')
                            ->find($product->category->id)
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

}