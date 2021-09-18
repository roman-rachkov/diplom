<?php

namespace App\Contracts\Repository;

use App\Models\Price;

interface OrderItemRepositoryContract
{
    public function add(Price $price, int $quantity): bool;

    public function setQuantity(Price $price, $quantity): bool;

    public function remove(Price $price): bool;

}
