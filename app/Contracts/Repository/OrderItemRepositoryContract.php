<?php

namespace App\Contracts\Repository;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Collection;

interface OrderItemRepositoryContract
{
    public function add(Product $product, int $quantity, Seller $seller = null): bool;

    public function setQuantity(Product $product, int $quantity): bool;

    public function setSeller(Product $product, int $sellerId): bool;

    public function remove(Product $product): bool;

    public function getCartByCustomer(Customer $customer);

    public function addHistoryPricesAndDiscounts(Order $order, Collection $cartItemsDTOs);

}
