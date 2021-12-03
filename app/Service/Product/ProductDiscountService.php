<?php

namespace App\Service\Product;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Collection;

class ProductDiscountService implements ProductDiscountServiceContract
{
    private DiscountRepositoryContract $repository;

    public function __construct(DiscountRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function getAllDiscounts(Collection $products): Collection // не используется
    {
       if ($products->count() === 1) {
           $discounts['products'] = $this->getProductDiscounts($products->first());
       }
       $discounts['groups'] = $this->getGroupDiscount($products);
       $discounts['category'] = $this->getCategoryDiscount($products);

        return collect($discounts);
    }

    public function getGeneralDiscount(Collection $products): Collection // TODO: не используется?
    {
        $generalDiscountsOfTypeWithoutKey = new Collection();

        $discounts = $this->getAllDiscounts($products);

        $discounts->each (function ($discount, $key) use (&$generalDiscountsOfTypeWithoutKey) {
            $maxDiscount = $discount->max();

            $generalDiscountsOfTypeWithoutKey = $generalDiscountsOfTypeWithoutKey
                ->merge(
                    $discount
                        ->filter(
                            function ($item) use ($maxDiscount) {
                                return $item == $maxDiscount;
                            })
                );
        });

            $maxDiscount = $generalDiscountsOfTypeWithoutKey->max();

            $generalDiscount = $generalDiscountsOfTypeWithoutKey->filter(function ($item) use ($maxDiscount) {
                return $item == $maxDiscount;
            });

        return $generalDiscount;
    }

    public function getPriceWithDiscount(Collection $products): float //TODO: не используется, убрать?
    {
        $discount = $this->getGeneralDiscount($products);

        $priceWithoutDiscount = 1000;

        $priceWithDiscount = $priceWithoutDiscount - $discount->max();

        return $priceWithDiscount > 0 ? $priceWithDiscount : 1;
    }

    public function getCatalogDiscounts(Collection $products): Collection
    {
        $result = [];
        // TODO: используется:
        // - в SellerController, для правильного отображения нужны цены
        // - в MainPageController, для топ продуктов и для продуктов ограниченного тиража, цены не нужны
        // - в CatalogPageController - цены не нужны
        // - в ViewedProductsService - цены не нужны


        foreach ($products as $product) {
            $result[$product->id] = $this->getProductPriceWithDiscount($product);
        }

        return new Collection($result);
    }

    public function getProductDiscounts( Product $product): float
    {
        $discounts = new Collection();

        return $discounts->max() ?: rand(100000, 500000) / 100;
    }

    protected function getGroupDiscount($product): float // TODO: не используется?
    {
        $discounts = new Collection();

        return $discounts->max() ?: round(rand(5,70)/100, 2);
    }

    protected function getCategoryDiscount($products): float // TODO: не используется?
    {
        $discounts = new Collection();

        return $discounts->max() ?: round(rand(5,70)/100, 2);
    }

    public function getProductPriceWithDiscount(Product $product, ?float $price = null): bool|float
    {
        $price = $price ?? $product->prices->avg('price');

        if ($discount = $this->repository->getProductDiscount($product)) {
            return $this->getPriceWithDiscountByDiscountMethod(
                $discount,
                $price
            );
        }

        return false;

    }

    public function getDiscountTextForIcon(Product $product): bool|string
    {
        if ($discount = $this->repository->getProductDiscount($product)) {

            $value = round($discount->value);

            switch ($discount->method_type) {
                case Discount::METHOD_CLASSIC:
                    return '-' . $value . '%' ;

                case Discount::METHOD_SUM:
                    return '-' . $value . '$';

                case Discount::METHOD_FIXED:
                    return 'FIX PRICE!';
            }

        }
        return false;
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
