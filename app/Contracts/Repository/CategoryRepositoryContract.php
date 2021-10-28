<?php

namespace App\Contracts\Repository;

use App\Models\Category;
use Illuminate\Support\Collection;
use Kalnoy\Nestedset\Collection as NestedsetCollection;

interface CategoryRepositoryContract
{
    public function getCategories():Collection;

    public function getAncestors(Category $category): NestedsetCollection;
}