<?php

namespace App\Contracts\Service;

use App\Models\Product;

interface AddToCartServiceContract
{
    public function add(Product $product, int $qty);
    public function remove(int $prodId);
    public function changeProductQuantity(int $prodId, $newQty = 1);
    public function getProductsList();
    public function getProductsQuantity();
}
