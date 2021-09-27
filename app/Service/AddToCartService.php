<?php

namespace App\Service;

use App\Contracts\Service\AddToCartServiceContract;
use App\Models\Product;

class AddToCartService implements AddToCartServiceContract
{
    public function add(Product $product, int $qty): bool
    {
        return (bool)rand(0, 1);
    }

    public function remove(int $prodId): bool
    {
        return (bool)rand(0, 1);
    }

    public function changeProductQuantity(int $prodId, int $newQty = 1): bool
    {
        return (bool)rand(0, 1);
    }

    public function getProductsList(): \Illuminate\Support\Collection
    {
        return collect();
    }

    public function getProductsQuantity(): int
    {
        return rand(0, 100);
    }

    public function clear(): bool {
        return (bool)rand(0, 1);
    }
}
