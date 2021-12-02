<?php

namespace App\Contracts\Repository;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Collection;

interface PriceRepositoryContract
{
    public function getAllPrices(): Collection;

    public function getMinPrice(): float;

    public function getMaxPrice(): float;

    public function getSellerProductPrice(Seller $seller, Product $product): float;
}
