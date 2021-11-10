<?php

namespace App\Service\Discount\MethodType;

class Fixed extends MethodType
{
    public function getPriceWithDiscount(?float $price): float
    {
        return max($this->discountValue, 1);
    }

    public function getTextForBadge(): string
    {
        return 'FIX PRICE!';
    }

}