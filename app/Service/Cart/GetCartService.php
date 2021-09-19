<?php

namespace App\Service\Cart;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\Cart\AddCartServiceContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Price;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class GetCartService implements GetCartServiceContract
{
    protected OrderItemRepositoryContract $repository;
    protected Customer $customer;

    public function __construct(OrderItemRepositoryContract $repository, Customer $customer)
    {
        $this->repository = $repository;
        $this->customer = $customer;
    }

    public function getItemsList(): Collection
    {
        return $this->customer->cart;
    }

    public function getProductsList(): Collection
    {
        return $this->getItemsList()->map(function ($item) {
            return $item->price->product;
        });
    }

    public function getProductsQuantity(): int
    {
        return $this->getItemsList()->sum('quantity');
    }

    public function getTotalCost(): float
    {
        return $this->getItemsList()->sum('sum');
    }
}
