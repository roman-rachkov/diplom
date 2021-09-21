<?php

namespace App\Repository;

use App\Contracts\Repository\AdminSettingsRepositoryContract;
use App\Contracts\Repository\PriceRepositoryContract;
use App\Models\Price;
use Illuminate\Support\Collection;

class PriceRepository implements PriceRepositoryContract
{
    public function __construct(Price $price, AdminSettingsRepositoryContract $adminsSettings)
    {
        $this->model = $price;
        $this->adminsSettings = $adminsSettings;
    }

    public function getAllPrices(): Collection
    {
        return $this->model->all();
    }

    public function getMaxPrice(): float
    {
        return $this->getAllPrices()->max('price');
    }

    public function getMinPrice(): float
    {
        return $this->getAllPrices()->min('price');
    }
}
