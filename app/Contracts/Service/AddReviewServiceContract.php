<?php

namespace App\Contracts\Service;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AddReviewServiceContract
{
    public function add(string $productId, User|Authenticatable $user, array $attributes);

    public function getReviews(Product $product);

    public function getReviewsCount(Product $product);

    public function getPaginatedReviews(Product $product, int $perPage = 3,int $currentPage = 1): LengthAwarePaginator;
}