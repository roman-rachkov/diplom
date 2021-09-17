<?php

namespace App\Service\Cart;

use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Models\Customer;

class GetCartService implements GetCartServiceContract
{
    protected Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getProductsList(): \Illuminate\Support\Collection
    {
        return $this->customer->cart;
    }

    public function getProductsQuantity(): int
    {
        return $this->getProductsList()->sum('quantity');
    }

}
