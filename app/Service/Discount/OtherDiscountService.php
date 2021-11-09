<?php

namespace App\Service\Discount;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Models\Product;

class OtherDiscountService
{
    private DiscountRepositoryContract $repository;

    public function __construct(DiscountRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function getProductsPricesWithDiscount()
    {

    }

    public function getProductPriceWithDiscount(Product $product, ?float $price = null): bool|float
    {
        $price = $price ?? $product->prices->avg('price');

        if ($discount = $this->repository->getMostWeightyProductDiscount($product)) {
            return $this->getPriceWithDiscountByDiscountMethod(
                $discount,
                $price
            );
        }

        return false;
    }


}