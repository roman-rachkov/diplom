<?php

namespace App\Contracts\Repository;

use App\Models\Customer;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Collection;

interface DiscountRepositoryContract
{
    public function getMostWeightyProductDiscount(Product $product) : ?Discount;

    public function getMostWeightyCartOnCartDiscount(string $customerId, int $productsQty, float $cartCost): ?Discount;

    public function getMostWeightyCartOnSetDiscount(string $customerId, Collection $productIds): ?array;

}