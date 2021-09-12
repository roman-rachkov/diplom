<?php

namespace App\Repository;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Models\Product;

class ProductRepository implements ProductRepositoryContract
{
    public function getAllProducts()
    {
        return Product::paginate(8);
    }
}
