<?php

namespace App\Service\Product;

use App\Contracts\Service\ProductsSortServiceContract;
use Illuminate\Support\Collection;

class ProductsSortService implements ProductsSortServiceContract
{

    public function sort(Collection $products, string $sortField, string $sortType)
    {
        // TODO: Implement sort() method.
    }
}