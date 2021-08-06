<?php

namespace App\Contracts\Product;

interface CreateProductServiceContract
{
    public function create(array $attributes);
}