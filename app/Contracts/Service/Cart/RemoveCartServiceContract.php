<?php

namespace App\Contracts\Service\Cart;

use App\Models\Price;

interface RemoveCartServiceContract
{
    /**
     * @param int $prodId
     * @return bool
     */
    public function remove(Price $product): bool;

    /**
     * @return bool
     */
    public function clear(): bool;

}
