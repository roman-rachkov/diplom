<?php

namespace App\Contracts\Service;

use App\Models\Price;
use Illuminate\Support\Collection;

interface CartServiceContract
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

    /**
     * @return array
     */
    public function getProductsList(): Collection;

    /**
     * @return int
     */
    public function getProductsQuantity(): int;

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
