<?php

namespace App\Service\Product;

use App\Contracts\Service\Product\ViewedProductsServiceContract;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ViewedProduct;
use Illuminate\Database\Eloquent\Collection;

class ViewedProductsService implements ViewedProductsServiceContract
{
    protected $customer;

    public  function __construct()
    {
        $this->customer = Customer::firstWhere('hash', session('customer_token'));
    }

    public function add(Product $product): bool
    {

        if ($this->isViewed($product)) {
            $this->remove($product);
        }

        ViewedProduct::create([
            'customer_id' => $this->customer->id,
            'product_id' => $product->id,
        ]);

        return true;
    }

    public function remove(Product $product): bool
    {
        return $this->customer->viewedProducts()->where('product_id', $product->id)->delete();
    }

    public function isViewed(Product $product): bool
    {
        return $this->customer->viewedProducts()->where('product_id', $product->id)->count();
    }

    public function getViewed(): Collection
    {
        return $this->customer->viewedProducts;
    }

    public function getViewedCount(): int
    {
        return $this->getViewed()->count();
    }

}
