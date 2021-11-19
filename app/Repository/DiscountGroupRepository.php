<?php

namespace App\Repository;

use App\Contracts\Repository\DiscountGroupRepositoryContract;
use App\Models\DiscountGroup;

class DiscountGroupRepository implements DiscountGroupRepositoryContract
{
    private $model;

    public function __construct(DiscountGroup $discountGroup)
    {
        $this->model = $discountGroup;
    }


    public function getRandomDiscountGroup()
    {
        return $this->model->inRandomOrder()->first();
    }}
