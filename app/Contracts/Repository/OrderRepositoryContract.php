<?php

namespace App\Contracts\Repository;

use App\DTO\OrderDTO;
use App\Models\Order;

interface OrderRepositoryContract
{
    public function add(OrderDTO $DTO): Order;
}
