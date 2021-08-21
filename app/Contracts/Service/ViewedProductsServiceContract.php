<?php

namespace App\Contracts\Service;

interface ViewedProductsServiceContract
{
    public function add($product);

    public function get();
}