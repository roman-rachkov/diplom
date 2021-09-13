<?php

namespace App\Service\Product;

use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Models\ComparedProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class CompareProductsService implements CompareProductsServiceContract
{

    public function add(Product $product): bool
    {
        return  (bool)rand(0, 1);
    }

    public function remove(Product $product): bool
    {
        return (bool)rand(0, 1);
    }

    public function get(int $quantity = 3): Collection
    {
        return ComparedProduct::factory()
            ->count($quantity)
            ->make()
            ->sortBy([['id', 'desc']]);
    }

    public function getCount(): int
    {
        return rand(1, 100);
    }
}