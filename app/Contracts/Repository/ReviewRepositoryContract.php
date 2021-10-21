<?php

namespace App\Contracts\Repository;

use App\Models\Review;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ReviewRepositoryContract
{
    public function store(array $attributes): null|Review;

    public  function getReviews(string $productId, int $count): Collection;

    public function getPaginatedReviews(string $productId, int $perPage, int $currentPage): LengthAwarePaginator;
}