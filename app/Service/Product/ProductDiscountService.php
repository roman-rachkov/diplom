<?php

namespace App\Service\Product;

use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;

class ProductDiscountService implements ProductDiscountServiceContract
{
    public function getAllDiscounts(Collection $products): Collection // не используется
    {
       if ($products->count() === 1) {
           $discounts['products'] = $this->getProductDiscounts($products->first());
       }
       $discounts['groups'] = $this->getGroupDiscount($products);
       $discounts['category'] = $this->getCategoryDiscount($products);

        return collect($discounts);
    }

    public function getGeneralDiscount(Collection $products): Collection // не используется
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

    public function getPriceWithDiscount(Collection $products): float // не используется
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
            $result[$product->id] = rand(100000, 500000) / 100;
        }

        return new Collection($result);
    }

    public function getProductDiscounts( Product $product): float
    {
        $discounts = new Collection();

        return $discounts->max() ?: rand(100000, 500000) / 100;
    }

    protected function getGroupDiscount($product): float
    {
        $discounts = new Collection();

        return $discounts->max() ?: round(rand(5,70)/100, 2);
    }

    protected function getCategoryDiscount($products): float
    {
        $discounts = new Collection();

        return $discounts->max() ?: round(rand(5,70)/100, 2);
    }

    public function getProductPriceWithDiscount(Product $product, float $price = null)
    {
        if (!$price) $price = $product->prices->avg('price');

        //Получить все скидки для данного товара с категорией other
    }

    protected function getPriceWithDiscountByDiscountMethod(Discount $discount, float $price)
    {
        switch ($discount->method_type) {
            case Discount::METHOD_CLASSIC:
                return $price * (1 - $discount->value/100);

            case Discount::METHOD_SUM:
                return max($price - $discount->value, 1);

            case Discount::METHOD_FIXED:
                return max($discount->value, 1);

        }
    }

}
