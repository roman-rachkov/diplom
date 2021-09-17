<?php

namespace App\Service\Cart;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\Cart\RemoveCartServiceContract;
use App\Models\Customer;
use App\Models\Price;

class RemoveCartService implements RemoveCartServiceContract
{

    protected OrderItemRepositoryContract $repository;

    public function __construct(OrderItemRepositoryContract $repository, Customer $customer)
    {
        $this->repository = $repository;
    }

    public function remove(Price $product): bool
    {
        return $this->repository->remove($product);
    }

    public function clear(): bool
    {
        return (bool)rand(0, 1);
    }
}
