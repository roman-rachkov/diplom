<?php

namespace App\Repository;

use App\Contracts\Repository\DiscountGroupRepositoryContract;
use App\Models\DiscountGroup;
use Illuminate\Database\Eloquent\Collection;

class DiscountGroupRepository implements DiscountGroupRepositoryContract
{
    private $model;

    public function __construct(DiscountGroup $discountGroup)
    {
        $this->model = $discountGroup;
    }

    public function all(): Collection
    {
        return $this->model->with(['products'])->get();
    }

    public function getRandomDiscountGroup(): DiscountGroup
    {
        return $this->all()->random();
    }

    public function hasProducts(): bool
    {
        return $this->model->has('products')->count() > 0;
    }
}
