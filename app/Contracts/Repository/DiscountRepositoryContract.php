<?php

namespace App\Contracts\Repository;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

interface DiscountRepositoryContract
{
    public function getProductDiscount(Product $product) : ?Discount;

    public function getOnCartDiscount(string $cacheAdditionKey, int $productsQty, float $cartCost): ?Discount;

    public function getOnSetDiscounts(): EloquentCollection;

    public function getAllActiveDiscount();

}
