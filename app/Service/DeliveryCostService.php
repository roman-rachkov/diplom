<?php

namespace App\Service;

use App\Contracts\Service\AdminSettingsServiceContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\DeliveryCostServiceContract;

class DeliveryCostService implements DeliveryCostServiceContract
{

    private AdminSettingsServiceContract $settings;

    public function __construct(GetCartServiceContract $cart, AdminSettingsServiceContract $settings)
    {
        $this->cart = $cart;
        $this->settings = $settings;
    }

    public function getCost($deliveryType)
    {
        return ($deliveryType === 'express' ? $this->settings->get('deliveryExpress', 500)
            : ($this->cart->getTotalCost() < $this->settings->get('minimalCartCost', 2000) ? $this->settings->get('deliveryPrice', 200) : 0));
    }
}
