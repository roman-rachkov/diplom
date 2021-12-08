<?php

namespace App\Contracts\Service;

use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderServiceContract
{
    public function getOrderItemsDTOs(): Collection;

    public function addHistory();
}