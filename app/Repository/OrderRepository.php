<?php

namespace App\Repository;

use App\Contracts\Repository\OrderRepositoryContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\CustomerServiceContract;
use App\DTO\OrderDTO;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryContract
{

    private Customer $customer;
    private GetCartServiceContract $cart;

    public function __construct(CustomerServiceContract $customer, GetCartServiceContract $cart)
    {
        $this->customer = $customer->getCustomer();
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

    public function getLastOrder(): Order
    {
        return $this->customer->orders()->latest()->first();
    }

    public function getAllOrders(): Collection
    {
        return $this->customer->orders()->latest()->get();
    }
}
