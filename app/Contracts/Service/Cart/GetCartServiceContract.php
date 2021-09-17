<?php

namespace App\Contracts\Service\Cart;

use Illuminate\Support\Collection;

interface GetCartServiceContract
{
    /**
     * @return array
     */
    public function getProductsList(): Collection;

    /**
     * @return int
     */
    public function getProductsQuantity(): int;

}
