<?php

namespace App\Service;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\CartServiceContract;
use App\Models\Customer;
use App\Models\Price;
use Illuminate\Support\Collection;

class CartService implements CartServiceContract
{
    protected OrderItemRepositoryContract $repository;
    protected Customer $customer;

    public function __construct(OrderItemRepositoryContract $repository, Customer $customer)
    {
        $this->repository = $repository;
        $this->customer = $customer;
    }

    public function add(Price $product, int $qty): bool
    {
        return $this->repository->add($product, $qty);
    }

    public function changeProductQuantity(Price $product, int $newQty = 1): bool
    {
        return $this->repository->setQuantity($product, $newQty);
    }

    public function getProductsList(): Collection
    {
        return $this->customer->cart;
    }

    public function getProductsQuantity(): int
    {
        return $this->getProductsList()->sum('quantity');
    }

    public function remove(Price $product): bool
    {
        return $this->repository->remove($product);
    }

    public function clear(): bool
    {
        foreach ($this->customer->cart as $item) {
            if (!$this->remove($item->price)) {
                return false;
            }
        }
        return true;
    }
}
