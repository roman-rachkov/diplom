<?php

namespace App\Contracts\Order;

interface UpdateOrderServiceContract
{
    public function update(array $attributes, string $id);
}