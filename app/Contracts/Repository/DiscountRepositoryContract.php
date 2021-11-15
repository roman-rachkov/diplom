<?php

namespace App\Contracts\Repository;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Collection;

interface DiscountRepositoryContract
{
    public function getMostWeightyProductDiscount(Product $product) : ?Discount;

    public function getMostWeightyCartOnCartDiscount(int $productsQty, float $cartCost): ?Discount;

    public function getMostWeightyCartOnSetDiscount(Collection $productIds): ?array;

}