<?php

namespace App\Contracts\Service;

use App\Models\Product;

interface AddToCartServiceContract
{
    /**
     * @param Product $product
     * @param int $qty
     * @return bool
     */
    public function add(Product $product, int $qty): bool;

    /**
     * @param int $prodId
     * @return bool
     */
    public function remove(int $prodId): bool;

    /**
     * @param int $prodId
     * @param int $newQty
     * @return bool
     */
    public function changeProductQuantity(int $prodId, int $newQty = 1): bool;

    /**
     * @return array
     */
    public function getProductsList(): array;

    /**
     * @return int
     */
    public function getProductsQuantity(): int;

    /**
     * @return bool
     */
    public function clear(): bool;
}
