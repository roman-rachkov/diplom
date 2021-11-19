<?php

namespace App\Service\Discount;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\Discount\MethodType\MethodTypeFactoryContract;
use App\Contracts\Service\Discount\OtherDiscountServiceContract;
use App\Models\Product;

class OtherDiscountService implements OtherDiscountServiceContract
{
    private DiscountRepositoryContract $repository;

    private MethodTypeFactoryContract $methodTypeFactory;

    public function __construct(DiscountRepositoryContract $repository, MethodTypeFactoryContract $methodTypeFactory)
    {
        $this->repository = $repository;
        $this->methodTypeFactory = $methodTypeFactory;
    }

    public function getProductsPricesWithDiscounts()
    {

    }

    public function getProductPriceWithDiscount(Product $product, ?float $price = null): bool|float
    {
        $price = $price ?? $product->prices->avg('price');

        if ($discount = $this->repository->getMostWeightyProductDiscount($product)) {
            return $this
                ->methodTypeFactory
                ->create($discount)
                ->getPriceWithDiscount($price);
        }

        return false;
    }

    public function getDiscountBadgeText(Product $product): bool|string
    {
        if ($discount = $this->repository->getMostWeightyProductDiscount($product)) {
            return $this
                ->methodTypeFactory
                ->create($discount)
                ->getTextForBadge();
        }
        return false;
    }

}