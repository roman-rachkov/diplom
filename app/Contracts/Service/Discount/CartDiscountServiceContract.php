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
}