<?php

namespace App\Repository;

use App\Contracts\Repository\PriceRepositoryContract;
use App\Models\Price;
use Illuminate\Support\Collection;

class PriceRepository implements PriceRepositoryContract
{
    private $model;

    public function __construct(Price $price)
    {
        $this->model = $price;
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

    public function getMaxPriceForCategory(Collection $arr): float
    {
        return $this->model->whereIn('product_id', $arr)->max('price');
    }

    public function getMinPriceForCategory(Collection $arr): float
    {
        dd($arr);
        return $this->model->whereIn('product_id', $arr)->min('price');
    }
}
