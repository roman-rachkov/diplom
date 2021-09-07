<?php

namespace App\Service;

use App\Contracts\Service\AddToCartServiceContract;
use App\Models\Product;

class AddToCartService implements AddToCartServiceContract
{
    public $cart = [];

    public function add(Product $product, int $qty)
    {

        $this->cart[$product->id] = ['product' => $product, 'quantity' => $qty];
        return $this->getProductsQuantity();
    }

    public function remove(int $prodId)
    {
        unset($this->cart[$prodId]);
        return $this->getProductsQuantity();
    }

    public function changeProductQuantity(int $prodId, $newQty = 1)
    {
        $this->cart[$prodId]['quantity'] = $newQty;
        return $this->getProductsQuantity();
    }

    public function getProductsList()
    {
        return $this->cart;
    }

    public function getProductsQuantity()
    {
        if ($this->cart) {
            return array_sum(array_map(fn($value) => $value['quantity'], $this->cart));
        }
        return 0;
    }

    public function clear() {
        $this->cart = [];
        return $this->getProductsQuantity();
    }
}
