<?php

namespace App\Service\Discount\MethodType;

use App\Contracts\Service\Discount\MethodType\MethodTypeContract;
use App\Contracts\Service\Discount\MethodType\MethodTypeFactoryContract;
use App\Models\Discount;

class MethodTypeFactory implements MethodTypeFactoryContract
{
    private static array $methodTypesInstances = [];

    public static function create(Discount $discount): MethodTypeContract
    {
        if (in_array($discount->method_type, static::$methodTypesInstances)) {
            return static::$methodTypesInstances[$discount->method_type];
        }

        return static::$methodTypesInstances[$discount->method_type] = new (__NAMESPACE__ . '\\' . ucfirst($discount->method_type))();

    }
}