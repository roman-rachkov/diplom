<?php

namespace App\Repository;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Price;

class OrderItemRepository implements OrderItemRepositoryContract
{

    protected Customer $customer;

    /**
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function add(Price $price, int $quantity): bool
    {
        $item = OrderItem::firstOrNew(
            [
                'price_id' => $price->id,
                'customer_id' => $this->customer->id
            ]
        );
        if ($item->id !== null) {
            return $this->setQuantity($price, $quantity);
        }
        $item->quantity = $quantity;
        $item->sum = $item->quantity * $price->price;
        return $item->save();
    }

    public function setSeller(OrderItem $item, Price $price)
    {
        $item->price_id = $price->id;
        $item->sum = $item->quantity * $price->price;
        return $item->save();
    }

    public function setQuantity(Price $price, $quantity): bool
    {
        $item = OrderItem::firstWhere(
            [
                'price_id' => $price->id,
                'customer_id' => $this->customer->id
            ]
        );

        if ($item === null) {
            return false;
        }

        if ($quantity <= 0) {
            return $this->remove($price);
        }

        $item->quantity = $quantity;
        $item->sum = $item->quantity * $price->price;
        return $item->save();
    }

    public function remove(Price $price): bool
    {
        return OrderItem::where([
            'price_id' => $price->id,
            'customer_id' => $this->customer->id
        ])->first()?->delete();
    }
}
