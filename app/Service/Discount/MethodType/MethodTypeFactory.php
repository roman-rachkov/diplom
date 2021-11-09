<?php

namespace App\Service\Discount\MethodType;

use App\Contracts\Service\Discount\MethodType\MethodTypeContract;
use App\Contracts\Service\Discount\MethodType\MethodTypeFactoryContract;
use App\Models\Discount;

class MethodTypeFactory implements MethodTypeFactoryContract
{
    public function create(Discount $discount): MethodTypeContract
    {
        return app()->makeWith($discount->method_type, ['discount' => $discount]);
    }
}