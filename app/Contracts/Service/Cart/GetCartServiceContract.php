<?php

namespace App\Contracts\Service\Cart;

use Illuminate\Support\Collection;

interface GetCartServiceContract
{
    /**
     * @return Collection
     */
    public function getProductsList(): Collection;

    /**
     * @return int
     */
    public function getProductsQuantity(): int;

    /**
     * @return float
     */
    public function getTotalCost(): float;

}
