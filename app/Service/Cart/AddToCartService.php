<?php

namespace App\Service\Cart;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\Cart\AddToCartServiceContract;
use App\Models\Price;

class AddToCartService implements AddToCartServiceContract
{
    protected OrderItemRepositoryContract $repository;

    public function __construct(OrderItemRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function add(Price $product, int $qty): bool
    {
        return $this->repository->add($product, $qty);
    }

    public function changeProductQuantity(Price $product, int $newQty = 1): bool
    {
        return $this->repository->setQuantity($product, $newQty);
    }
}
