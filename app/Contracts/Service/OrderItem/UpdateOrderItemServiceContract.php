<?php

namespace App\Contracts\Service\OrderItem;

interface UpdateOrderItemServiceContract
{
    public function update(array $attributes, string $id);
}