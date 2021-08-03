<?php

namespace App\Service;

use App\Contracts\ProductsSortServiceContract;
use Illuminate\Support\Collection;

class ProductsSortService implements ProductsSortServiceContract
{

    public function sort(Collection $products, string $sortField, string $sortType)
    {
        // TODO: Implement sort() method.
    }
}