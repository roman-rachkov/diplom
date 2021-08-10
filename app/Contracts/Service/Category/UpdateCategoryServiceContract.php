<?php

namespace App\Contracts\Service\Category;

interface UpdateCategoryServiceContract
{
    public function update(array $attributes, string $id);
}