<?php

namespace App\Contracts\Product;

interface CompareProductsServiceContract
{
    public function add($product);

    public function get();
}