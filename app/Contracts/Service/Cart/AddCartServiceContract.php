<?php

namespace App\Contracts\Service\Cart;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Collection;

interface AddCartServiceContract
{
    /**
     * @param Product $product
     * @param int $qty
     * @return bool
     */
    public function add(Product $product, int $qty, Seller $seller = null): bool;

    /**
     * @param Product $product
     * @param int $newQty
     * @return bool
     */
    public function changeProductQuantity(Product $product, int $newQty = 1): bool;

}
