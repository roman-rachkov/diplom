<?php

namespace App\Service\Cart;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\Cart\AddCartServiceContract;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Seller;

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
        return $this->repository->add($product, $qty, $seller);
    }

    public function changeProductQuantity(Product $product, int $newQty = 1): bool
    {
        return $this->repository->setQuantity($product, $newQty);
    }

    public function update(Product $product, array $data)
    {
        $status = true;
        foreach ($data as $key => $value) {
            if (!$this->$key($product, $value)) {
                $status = false;
            }
        }
        return $status;
    }

    public function setSeller(Product $product, int $newSellerId): bool
    {
        return $this->repository->setSeller($product, $newSellerId);
    }

    public function quantity(Product $product, int $newQty)
    {
        return $this->changeProductQuantity($product, $newQty);
    }

    public function seller(Product $product, int $newSellerId)
    {
        return $this->setSeller($product, $newSellerId);
    }
}
