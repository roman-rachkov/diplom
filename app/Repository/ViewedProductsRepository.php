<?php

namespace App\Repository;

use App\Contracts\Repository\ViewedProductsRepositoryContract;
use App\Models\ViewedProduct;
use Illuminate\Database\Eloquent\Builder;

class ViewedProductsRepository implements ViewedProductsRepositoryContract
{
    public function create(array $attribute): ViewedProduct
    {
        return ViewedProduct::create($attribute);
    }

    public function allQuery(): Builder
    {
        return ViewedProduct::query();
    }
}
