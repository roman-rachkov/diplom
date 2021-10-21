<?php

namespace App\Contracts\Repository;

use App\Models\ViewedProduct;

interface ViewedProductsRepositoryContract
{
    public function create(array $attribute): ViewedProduct;
}
