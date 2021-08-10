<?php

namespace App\Contracts\Service;

interface DeliveryCostServiceContract
{
    public function getCost($products, $deliveryType);
}