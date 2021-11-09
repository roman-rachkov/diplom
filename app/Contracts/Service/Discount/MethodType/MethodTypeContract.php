<?php

namespace App\Contracts\Service\Discount\MethodType;

interface MethodTypeContract
{
    public function getPriceWithDiscount(?float $price): float;

    public function getTextForBadge(): string;
}