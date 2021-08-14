<?php

namespace App\Contracts\Service\Product;

use Illuminate\Support\Collection;

interface ProductsSortServiceContract
{
    public function sort(string $sortField,string $sortType);
}