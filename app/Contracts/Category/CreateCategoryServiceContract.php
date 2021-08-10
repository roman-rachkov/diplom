<?php

namespace App\Contracts\Category;

interface CreateCategoryServiceContract
{
    public function create(array $attributes);
}