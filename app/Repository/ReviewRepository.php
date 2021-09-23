<?php

namespace App\Repository;

use App\Contracts\Repository\ReviewRepositoryContract;
use App\Models\Review;
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
}