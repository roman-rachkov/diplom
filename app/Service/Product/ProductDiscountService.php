<?php

namespace App\Service\Product;

use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Models\Product;
use Illuminate\Support\Collection;

class ProductDiscountService implements ProductDiscountServiceContract
{
    public function getAllDiscounts(Collection $products): Collection
    {
       $discounts['products'] = $this->getProductDiscount($products);
       $discounts['groups'] = $this->getGroupDiscount($products);
       $discounts['category'] = $this->getCategoryDiscount($products);

        return collect($discounts);
    }

    public function getGeneralDiscount(Collection $products): Collection
    {
        $generalDiscountsOfTypeWithoutKey = new Collection();

        $discounts = $this->getAllDiscounts($products);

        $discounts->each (function ($discount, $key) use (&$generalDiscountsOfTypeWithoutKey) {
            $maxDiscount = $discount->max();

            $generalDiscountsOfTypeWithoutKey = $generalDiscountsOfTypeWithoutKey->merge( $discount->filter(function ($item) use ($maxDiscount) {
                return $item == $maxDiscount;
            }));
        });

            $maxDiscount = $generalDiscountsOfTypeWithoutKey->max();

            $generalDiscount = $generalDiscountsOfTypeWithoutKey->filter(function ($item) use ($maxDiscount) {
                return $item == $maxDiscount;
            });

        return $generalDiscount;
    }

    public function getPriceWithDiscount(Collection $products): int
    {
        $discount = $this->getGeneralDiscount($products);

        $priceWithoutDiscount = 1000;

        $priceWithDiscount = $priceWithoutDiscount - $discount->max();

        return $priceWithDiscount > 0 ? $priceWithDiscount : 1;
    }

    public function getCatalogDiscounts(Collection $products): Collection
    {
        $result = [];

        foreach ($products as $product) {
            $result[$product->id] = rand(500, 2500);
        }

        return new Collection($result);
    }

    protected function getProductDiscount($products): Collection
    {
        $discounts = new Collection();

        return $discounts;
    }

    protected function getGroupDiscount($product): Collection
    {
        $discounts = new Collection();

        return $discounts;
    }

    protected function getCategoryDiscount($products): Collection
    {
        $discounts = new Collection();

        return $discounts;
    }

}
