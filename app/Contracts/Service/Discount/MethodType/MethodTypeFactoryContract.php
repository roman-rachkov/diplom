<?php

namespace App\Contracts\Service\Discount\MethodType;

use App\Models\Discount;

interface MethodTypeFactoryContract
{
    public function create(Discount $discount): MethodTypeContract;
}