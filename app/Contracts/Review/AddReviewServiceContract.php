<?php

namespace App\Contracts\Review;

interface AddReviewServiceContract
{
    public function addReview($product, $review);
}