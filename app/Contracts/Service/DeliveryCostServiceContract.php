<?php

namespace App\Contracts\Service;

use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Models\OrderItem;

interface DeliveryCostServiceContract
{
    public function getCost(string $deliveryType);
}
