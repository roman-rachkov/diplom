<?php

namespace App\Service\Discount\MethodType;

class Sum extends MethodType
{
    public function getPriceWithDiscount(?float $price): float
    {
        return max($price - $this->discountValue, 1);
    }
}