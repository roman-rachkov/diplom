<?php

namespace App\Contracts\Category;

interface UpdateCategoryServiceContract
{
    public function update(array $attributes, string $id);
}