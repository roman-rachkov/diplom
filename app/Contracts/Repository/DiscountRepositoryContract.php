<?php

namespace App\Contracts\Repository;

use App\Models\Discount;
use App\Models\Product;

interface DiscountRepositoryContract
{
    public function getMostWeightyProductDiscount(Product $product) : null|Discount;

    public function getMostWeightyCartDiscount(int $productsQty, float $cartCost): Discount;

}