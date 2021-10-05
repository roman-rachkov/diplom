<?php

namespace App\Contracts\Repository;

use App\DTO\OrderDTO;
use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderRepositoryContract
{
    public function add(OrderDTO $DTO): Order;

    public function getLastOrder(): Order;
    public function getAllOrders(): Collection;
}
