<?php

namespace App\Contracts\Service\Delivery;

interface UpdateDeliveryServiceContract
{
    public function update(array $attributes, string $id);
}