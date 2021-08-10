<?php

namespace App\Contracts\Service\Review;

interface UpdateReviewServiceContract
{
    public function update(array $attributes, string $id);
}