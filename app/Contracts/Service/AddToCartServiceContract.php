<?php

namespace App\Contracts\Service;

use App\Models\Product;

interface AddToCartServiceContract
{
    public function add(Product $product);
}