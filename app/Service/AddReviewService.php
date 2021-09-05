<?php

namespace App\Service;

use App\Contracts\Service\AddReviewServiceContract;
use App\Models\Product;

class AddReviewService implements AddReviewServiceContract
{

    public function add(Product $product, array $attributes)
    {
        $product->reviews()->create($attributes);
    }

    public function getReviews(Product $product)
    {
        $product->refresh();
        return $product->reviews;
    }

    public function getReviewsCount(Product $product)
    {
        return $this->getReviews($product)->count();
    }
}