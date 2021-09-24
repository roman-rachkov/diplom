<?php

namespace App\Contracts\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ReviewRepositoryContract
{
    public function store(array $attributes): bool;

    public  function getReviews(string $productId, int $count): Collection;

    public function getPaginatedReviews(string $productId, int $perPage, int $currentPage): LengthAwarePaginator;
}