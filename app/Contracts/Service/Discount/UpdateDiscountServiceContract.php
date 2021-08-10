<?php

namespace App\Contracts\Service\Discount;

interface UpdateDiscountServiceContract
{
    public function update(array $attributes, string $id);
}