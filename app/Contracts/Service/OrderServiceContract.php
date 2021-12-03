<?php

namespace App\Contracts\Service;

use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderServiceContract
{
    public function getOrderItemsDTOs(Order $order): Collection;

    public function addHistory(Order $order);
}