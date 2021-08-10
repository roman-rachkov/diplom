<?php

namespace App\Contracts\Service\Order;

interface UpdateOrderServiceContract
{
    public function update(array $attributes, string $id);
}