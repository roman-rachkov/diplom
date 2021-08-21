<?php

namespace App\Contracts\Service;

use App\Models\Product;

interface AddReviewServiceContract
{
    public function add(Product $product, array $attributes);
}