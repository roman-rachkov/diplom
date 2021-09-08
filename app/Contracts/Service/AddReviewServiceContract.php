<?php

namespace App\Contracts\Service;

use App\Models\Product;

interface AddReviewServiceContract
{
    public function add(Product $product, array $attributes);

    public function getReviews(Product $product);

    public function getReviewsCount(Product $product);
}