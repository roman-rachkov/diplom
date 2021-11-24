<?php

namespace App\Repository;

use App\Contracts\Repository\DiscountGroupRepositoryContract;
use App\Models\DiscountGroup;

class DiscountGroupRepository implements DiscountGroupRepositoryContract
{
    private DiscountGroup $model;

    public function __construct(DiscountGroup $discountGroup)
    {
        $this->model = $discountGroup;
    }

    public function getRandomDiscountGroup(): DiscountGroup
    {
        return $this->model->with(['products'])->inRandomOrder()->first();
    }

    public function hasProducts(): bool
    {
        return $this->model->has('products')->count() > 0;
    }
}
