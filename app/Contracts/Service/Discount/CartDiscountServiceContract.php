<?php

namespace App\Contracts\Service\Discount;

use Illuminate\Support\Collection;

interface CartDiscountServiceContract
{
    public function getCartItemsDTOs(
        Collection $cart,
        int $cartQuantity,
        float $cartCost,
        string $customerId
    ): Collection;

    public function getOrderItemsDTOs(
        Collection $orderItems,
        int $itemsQuantity,
        float $itemsCost,
        string $orderId
    ): Collection;
}