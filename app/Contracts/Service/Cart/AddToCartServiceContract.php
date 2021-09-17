<?php

namespace App\Contracts\Service\Cart;

use App\Models\Price;

interface AddToCartServiceContract
{

    /**
     * @param Price $product
     * @param int $qty
     * @return bool
     */
    public function add(Price $product, int $qty): bool;

    /**
     * @param int $prodId
     * @param int $newQty
     * @return bool
     */
    public function changeProductQuantity(Price $product, int $newQty = 1): bool;

}
