<?php

namespace App\Repository;

use App\Contracts\Repository\ViewedProductsRepositoryContract;
use App\Models\ViewedProduct;

class ViewedProductsRepository implements ViewedProductsRepositoryContract
{
    public function create(array $attribute): ViewedProduct
    {
        return ViewedProduct::create($attribute);
    }
}
