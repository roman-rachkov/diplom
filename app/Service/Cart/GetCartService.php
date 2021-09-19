<?php

namespace App\Service\Cart;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
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
    protected AdminSettingsServiceContract $settings;

    public function __construct(OrderItemRepositoryContract $repository, Customer $customer, AdminSettingsServiceContract $settings)
    {
        $this->repository = $repository;
        $this->customer = $customer;
        $this->settings = $settings;
    }

    public function getItemsList(): Collection
    {
        return cache()->tags(['cart', 'orderItems'])->remember(
            'cart-' . $this->customer->id . '-items',
            $this->settings->get('cartCacheLifeTime', 20 * 60),
            function () {
                return $this->customer->cart;
            }
        );
    }

    public function getProductsList(): Collection
    {
        return cache()->tags(['cart', 'orderItems', 'products'])->remember(
            'cart-' . $this->customer->id . '-products',
            $this->settings->get('cartCacheLifeTime', 20 * 60),
            function () {
                return $this->getItemsList()->map(function ($item) {
                    return $item->price->product;
                });
            }
        );
    }

    public function getProductsQuantity(): int
    {
        return cache()->tags(['cart', 'orderItems', 'products'])->remember(
            'cart-' . $this->customer->id . '-products-quantity',
            $this->settings->get('cartCacheLifeTime', 20 * 60),
            function () {
                return $this->getItemsList()->sum('quantity');
            }
        );
    }

    public function getTotalCost(): float
    {
        return cache()->tags(['cart', 'orderItems'])->remember(
            'cart-' . $this->customer->id . '-cost',
            $this->settings->get('cartCacheLifeTime', 20 * 60),
            function () {
                return $this->getItemsList()->sum('sum');
            }
        );
    }
}
