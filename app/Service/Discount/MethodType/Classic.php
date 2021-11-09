<?php

namespace App\Service\Discount\MethodType;

class Classic extends MethodType
{
    public function getPriceWithDiscount(?float $price): float
    {
        return $price * (1 - $this->discountValue/100);
    }

    public function getTextForBadge(): string
    {
        return '-' . $this->getBadgeValue() . '%' ;
    }
}