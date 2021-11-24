<?php

namespace App\Contracts\Repository;

use App\Models\DiscountGroup;

interface DiscountGroupRepositoryContract
{
    public function getRandomDiscountGroup(): DiscountGroup;

    public function hasProducts(): bool;
}
