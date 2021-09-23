<?php

namespace App\Contracts\Service\Cart;

use App\Models\Product;

interface RemoveCartServiceContract
{
    /**
     * @param Product $product
     * @return bool
     */
    public function remove(Product $product): bool;

    /**
     * @return bool
     */
    public function clear(): bool;
}
