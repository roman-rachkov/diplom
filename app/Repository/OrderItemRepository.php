<?php

namespace App\Repository;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Price;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Builder;

class OrderItemRepository implements OrderItemRepositoryContract
{

    protected Customer $customer;

    /**
     * @param CustomerServiceContract $customer
     */
    public function __construct(CustomerServiceContract $customer)
    {
        $this->customer = $customer->getCustomer();
    }

    public function add(Product $product, int $quantity, Seller $seller = null): bool
    {
        $item = OrderItem::where([
            ['order_id', '=', null],
            ['customer_id', '=', $this->customer->id]
        ])->whereHas('price', fn($query) => $query->where('product_id', $product->id))->firstOrNew();

        if ($item->id !== null) {
            return $this->setQuantity($product, $quantity);
        }

        $params[] = ['product_id', '=', $product->id];
        if ($seller) {
            $params[] = ['seller_id', '=', $seller->id];
        }

        $price = Price::where($params)->inRandomOrder()->first();
        $item->price()->associate($price);
        $item->customer()->associate($this->customer);
        $item->quantity = $quantity;
        return $item->save();
    }

    public function setSeller(Product $product, int $sellerId): bool
    {
        $item = $this->getCartItem($product);
        $price = Price::firstWhere([
            'product_id' => $product->id,
            'seller_id' => $sellerId,
        ]);
        $item->price()->associate($price);
        return $item->save();
    }

    public function setQuantity(Product $product, int $quantity): bool
    {
        $item = $this->getCartItem($product);

        if ($item === null) {
            return false;
        }

        if ($quantity <= 0) {
            return $this->remove($product);
        }

        $item->quantity = $quantity;
        return $item->save();
    }

    public function remove(Product $product): bool
    {
        return $this->getCartItem($product)?->delete();
    }

    public function getCartItem(Product $product): OrderItem
    {
        return OrderItem::whereHas('price', function (Builder $query) use ($product) {
            return $query->where('product_id', $product->id);
        })->where([
            'order_id' => null,
            'customer_id' => $this->customer->id,
        ])->first();
    }
}
