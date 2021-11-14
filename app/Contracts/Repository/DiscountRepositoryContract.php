<?php

namespace App\Contracts\Repository;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

interface DiscountRepositoryContract
{
    public function getMostWeightyProductDiscount(Product $product) : null|Discount;

    public function getAllActiveDiscount(): Builder;

}
