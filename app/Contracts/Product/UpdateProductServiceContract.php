<?php

namespace App\Contracts\Product;

interface UpdateProductServiceContract
{
    public function update(array $attributes, string $id);
}