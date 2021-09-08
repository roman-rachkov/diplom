<?php

namespace App\Service;

use App\Contracts\Service\AddReviewServiceContract;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

class AddReviewService implements AddReviewServiceContract
{

    public function add(Product $product, array $attributes) : bool
    {
        return (bool)rand(1,0);
    }

    public function getReviews(Product $product) : Collection
    {
        return Review::factory()->count(rand(3,10))->make();
    }

    public function getReviewsCount(Product $product) : int
    {
        return rand(3,10);
    }
}