<?php

namespace App\Contracts\Service\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface CompareProductsServiceContract
{
    public function add(Product $product);

    public function remove(Product $product);

    public function get(int $quantity = 3): Collection;

    public function getCount(): int;
}