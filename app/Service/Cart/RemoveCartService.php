<?php

namespace App\Service\Cart;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\Cart\RemoveCartServiceContract;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class RemoveCartService implements RemoveCartServiceContract
{
    protected OrderItemRepositoryContract $repository;
    protected Customer $customer;

    public function __construct(OrderItemRepositoryContract $repository, Customer $customer)
    {
        $this->repository = $repository;
        $this->customer = $customer;
    }

    public function remove(Product $product): bool
    {
        $price = OrderItem::whereHas('price',function (Builder $query) use($product){
            return $query->where('product_id', $product->id);
        })->where([
            'order_id' => null,
            'customer_id' => $this->customer->id,
        ])->first()->price;
        return $this->repository->remove($price);
    }

    public function clear(): bool
    {
        foreach ($this->customer->cart as $item) {
            if (!$this->remove($item->price->product)) {
                return false;
            }
        }
        return true;
    }
}
