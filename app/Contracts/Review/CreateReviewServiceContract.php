<?php

namespace App\Contracts\Review;

interface CreateReviewServiceContract
{
    public function create(array $attributes);
}