<?php

namespace App\Contracts\Repository;

use Illuminate\Support\Collection;

interface PriceRepositoryContract
{
    public function getAllPrices(): Collection;

    public function getMinPrice(): float;

    public function getMaxPrice(): float;
}
