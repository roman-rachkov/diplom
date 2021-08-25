<?php

namespace App\Contracts\Repository;

use Illuminate\Support\Collection;

interface CategoryRepositoryContract
{
    public function getCategories():Collection;
}