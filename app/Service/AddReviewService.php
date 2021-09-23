<?php

namespace App\Service;

use App\Contracts\Repository\ReviewRepositoryContract;
use App\Contracts\Service\AddReviewServiceContract;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

class AddReviewService implements AddReviewServiceContract
{
    private ReviewRepositoryContract $repository;

    public function __construct(ReviewRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function add(
        string $productId,
        User|Authenticatable $user,
        array $attributes
    ) : bool
    {
        $attributes['product_id'] = $productId;
        $attributes['user_id'] = $user->id;

        if (!$this->repository->store($attributes)) {
            throw new Exception("Can't store review model instance");
        }

        return true;
    }

    public function getReviews(Product $product, $count = 3) : Collection
    {
        return $this->repository->getReviews($product->id, $count);
    }

    public function getReviewsCount(Product $product) : int
    {
        return $product->reviews()->count();
    }
}