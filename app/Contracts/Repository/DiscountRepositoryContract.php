<?php

namespace App\Contracts\Repository;

use App\Models\Discount;
use App\Models\Product;

interface DiscountRepositoryContract
{
    public function getMostWeightyProductDiscount(Product $product) : Discount;

}