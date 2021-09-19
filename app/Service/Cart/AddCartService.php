<?php

namespace App\Service\Cart;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\Cart\AddCartServiceContract;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Price;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class AddCartService implements AddCartServiceContract
{
    protected OrderItemRepositoryContract $repository;
    protected Customer $customer;

    public function __construct(OrderItemRepositoryContract $repository, Customer $customer)
    {
        $this->repository = $repository;
        $this->customer = $customer;
    }

    public function add(Product $product, int $qty, Seller $seller = null): bool
    {
        $params = ['product_id' => $product->id];
        if($seller){
            $params[] = ['seller_id' => $seller->id];
        }
        $price = Price::firstWhere($params);
        return $this->repository->add($price, $qty);
    }

    public function changeProductQuantity(Product $product, int $newQty = 1): bool
    {
        $price = OrderItem::whereHas('price',function (Builder $query) use($product){
            return $query->where('product_id', $product->id);
        })->where([
            'order_id' => null,
            'customer_id' => $this->customer->id,
        ])->first()->price;
        return $this->repository->setQuantity($price, $newQty);
    }

    public function getItemsList(): Collection
    {
        return $this->customer->cart;
    }

    public function getProductsList(): Collection
    {
        return $this->getItemsList()->map(function ($item){
            return $item->price->product;
        });
    }

    public function getProductsQuantity(): int
    {
        return $this->getItemsList()->sum('quantity');
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
