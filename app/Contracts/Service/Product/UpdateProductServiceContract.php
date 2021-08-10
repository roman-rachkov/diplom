<?php

namespace App\Contracts\Service\Product;

interface UpdateProductServiceContract
{
    public function update(array $attributes, string $id);
}