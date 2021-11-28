<?php

namespace App\Service\Discount\MethodType;

use App\Contracts\Service\Discount\MethodType\MethodTypeContract;
use App\Models\Discount;

abstract class MethodType implements MethodTypeContract
{
    protected float $discountValue;

    public function __construct(Discount $discount)
    {
        $this->discountValue = $discount->value;
    }

}