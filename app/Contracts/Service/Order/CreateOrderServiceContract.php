<?php

namespace App\Contracts\Service\Order;

interface CreateOrderServiceContract
{
    public function create(array $attributes);
}