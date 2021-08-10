<?php

namespace App\Contracts\Review;

interface UpdateReviewServiceContract
{
    public function update(array $attributes, string $id);
}