<?php

namespace App\Contracts\Service\OrderItem;

interface CreateOrderItemServiceContract
{
    public function create(array $attributes);
}