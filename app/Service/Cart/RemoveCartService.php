<?php

namespace App\Service\Cart;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\Cart\RemoveCartServiceContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class RemoveCartService implements RemoveCartServiceContract
{
    protected OrderItemRepositoryContract $repository;
    protected Customer $customer;

    public function __construct(OrderItemRepositoryContract $repository, CustomerServiceContract $customerService)
    {
        $this->repository = $repository;
        $this->customer = $customerService->getCustomer();
    }

    public function remove(Product $product): bool
    {
        return $this->repository->remove($product);
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
