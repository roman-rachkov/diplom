<?php

namespace App\Contracts\Service;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Collection;

interface CartServiceContract
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

    /**
     * @return array
     */
    public function getProductsList(): Collection;

    /**
     * @return int
     */
    public function getProductsQuantity(): int;

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
