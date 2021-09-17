<?php

namespace App\Contracts\Repository;

use App\Models\Price;

interface OrderItemRepositoryContract
{
    public function add(Price $product, int $quantity): bool;

    public function setQuantity(Price $product, $quantity): bool;

    public function remove(Price $product): bool;

}
