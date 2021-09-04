<?php

namespace App\Contracts\Service\Product;

use App\Models\Product;

interface CompareProductsServiceContract
{
    public function add(Product $product);

    public function remove(Product $product);

    public function get(int $quantity = 3);

    public function getCount();
}