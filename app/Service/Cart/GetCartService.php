<?php

namespace App\Service\Cart;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Models\Customer;
use Illuminate\Support\Collection;

class GetCartService implements GetCartServiceContract
{
    protected OrderItemRepositoryContract $repository;
    protected Customer $customer;
    protected AdminSettingsServiceContract $settings;

    public function __construct(OrderItemRepositoryContract $repository, CustomerServiceContract $customerService, AdminSettingsServiceContract $settings)
    {
        $this->repository = $repository;
        $this->customer = $customerService->getCustomer();
        $this->settings = $settings;
    }

    public function getItemsList(): Collection
    {
        return cache()->tags(['cart', 'orderItems'])->remember(
            'cart-' . $this->customer->id . '-items',
            $this->settings->get('cartCacheLifeTime', 20 * 60),
            function () {
                return $this->repository->getCartByCustomer($this->customer);
            }
        );
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
