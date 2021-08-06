<?php

namespace App\Contracts\Product;

use Illuminate\Support\Collection;

interface ProductsSortServiceContract
{
    public function sort(Collection $products,string $sortField,string $sortType);
}