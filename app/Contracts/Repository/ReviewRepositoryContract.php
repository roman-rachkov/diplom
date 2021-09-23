<?php

namespace App\Contracts\Repository;

use Illuminate\Support\Collection;

interface ReviewRepositoryContract
{
    public function store(array $attributes): bool;

    public  function getReviews(string $productId, int $count): Collection;
}