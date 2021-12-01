<?php

namespace App\Contracts\Service\Cart;

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
    public function getProductsQuantity(): int;

    /**
     * @return float
     */
    public function getTotalCost(): float;

    public function getCartCost(): float;

}
