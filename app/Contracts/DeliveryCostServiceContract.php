<?php

namespace App\Contracts;

interface DeliveryCostServiceContract
{
    public function getCost($products, $deliveryType);
}