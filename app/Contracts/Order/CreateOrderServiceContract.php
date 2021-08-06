<?php

namespace App\Contracts\Order;

interface CreateOrderServiceContract
{
    public function create(array $attributes);
}