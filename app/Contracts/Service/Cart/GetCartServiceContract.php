<?php

namespace App\Contracts\Service\Cart;

use App\Models\Customer;
use Illuminate\Support\Collection;

interface GetCartServiceContract
{
    /**
     * @return Collection
     */
    public function getCartItemsDTOs(): Collection;

    /**
     * @return int
     */
    public function getCartProductsQuantity(): int;

    /**
     * @return float
     */
    public function getTotalCost(): float;

    public function getCartCost(): float;

    public function getCartItemsList(): Collection;

}
