<?php

namespace App\Repository;

use App\Contracts\Repository\ReviewRepositoryContract;
use App\Models\Review;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ReviewRepository implements ReviewRepositoryContract
{
    public function store(array $attributes): bool
    {
        return (new Review($attributes))->save();
    }

    public  function getReviews(string $productId, int $count): Collection
    {
        return Review::where('product_id', $productId)->limit($count)->get();
    }

    public function getPaginatedReviews(
        string  $productId,
        int     $perPage,
        int     $currentPage
    ): LengthAwarePaginator
    {
        return Review::where('product_id',$productId)->with('user:id,name')
            ->paginate(perPage: $perPage, page: $currentPage);
    }
}