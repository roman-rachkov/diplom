<?php

namespace App\Contracts;

interface AddReviewServiceContract
{
    public function addReview($product, $review);
}