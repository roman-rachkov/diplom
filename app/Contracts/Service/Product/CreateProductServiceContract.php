<?php

namespace App\Contracts\Service\Product;

interface CreateProductServiceContract
{
    public function create(array $attributes);
}