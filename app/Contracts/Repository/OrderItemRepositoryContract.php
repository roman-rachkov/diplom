<?php

namespace App\Contracts\Repository;

use App\Models\Product;
use App\Models\Seller;

interface OrderItemRepositoryContract
{
    public function add(Product $product, int $quantity, Seller $seller = null): bool;

    public function setQuantity(Product $product, $quantity): bool;

    public function remove(Product $product): bool;

}
