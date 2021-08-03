<?php

namespace App\Contracts;

interface ViewedProductsServiceContract
{
    public function add($product);

    public function get();
}