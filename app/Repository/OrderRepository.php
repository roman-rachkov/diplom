<?php

namespace App\Repository;

use App\Contracts\Repository\OrderRepositoryContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\DTO\OrderDTO;
use App\Models\Customer;
use App\Models\Order;

class OrderRepository implements OrderRepositoryContract
{

    private Customer $customer;
    private GetCartServiceContract $cart;

    public function __construct(Customer $customer, GetCartServiceContract $cart)
    {
        $this->customer = $customer;
        $this->cart = $cart;
    }

    public function add(OrderDTO $DTO): Order
    {
        $order = Order::create([
            'customer_id' => $this->customer->id,
            'full_name' => $DTO->name,
            'email' => $DTO->email,
            'phone' => $DTO->phone,
            'delivery_type' => $DTO->deliveryType,
            'city' => $DTO->city,
            'address' => $DTO->address,
            'total' => $DTO->totalCost,
            'comment' => $DTO->comment,
        ]);

        $order->items()->saveMany($this->cart->getItemsList());
        return $order;
    }
}
