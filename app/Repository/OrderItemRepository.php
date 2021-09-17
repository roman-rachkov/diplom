<?php

namespace App\Repository;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Models\Customer;
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

    public function add(Price $product, int $quantity): bool
    {
        $item = OrderItem::firstOrNew(
            [
                'product_id' => $product->id,
                'customer_id' => $this->customer->id
            ]
        );
        if ($item->id !== null) {
            return $this->setQuantity($product, $quantity);
        }
        $item->quantity = $quantity;
        return $item->save();
    }

    public function setQuantity(Price $product, $quantity): bool
    {
        $item = OrderItem::firstWhere(
            [
                'product_id' => $product->id,
                'customer_id' => $this->customer->id
            ]
        );

        if ($item === null) {
            return false;
        }

        if ($item->quantity + $quantity <= 0) {
            return $this->remove($product);
        }

        $item->quantity += $quantity;
        return $item->save();
    }

    public function remove(Price $product): bool
    {
        return OrderItem::where([
            'product_id' => $product->id,
            'customer_id' => $this->customer->id
        ])->first()?->delete();
    }
}
