<?php

namespace App\Service\Product;

use App\Contracts\Service\Product\ViewedProductsServiceContract;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ViewedProduct;
use Illuminate\Database\Eloquent\Collection;

class ViewedProductsService implements ViewedProductsServiceContract
{
    public function getCustomer(): Customer
    {
        $user = auth()->user();

        if ($user) {
            $customer = $user->customer;
        } else {
            $customer = Customer::firstWhere('hash', session('customer_token'));
        }

        return $customer;
    }

    public function add(Product $product): bool
    {

        if ($this->isViewed($product)) {
            $this->remove($product);
        }

        ViewedProduct::create([
            'customer_id' => $this->getCustomer()->id,
            'product_id' => $product->id,
        ]);

        return true;
    }

    public function remove(Product $product): bool
    {
        return $this->getCustomer()->viewedProducts()->where('product_id', $product->id)->delete();
    }

    public function isViewed(Product $product): bool
    {
        return $this->getCustomer()->viewedProducts()->where('product_id', $product->id)->count();
    }

    public function getViewed(): Collection
    {
        $viewedProducts = $this->getCustomer()->viewedProducts->sortByDesc('created_at');

        $products = $viewedProducts->map(function ($viewedProduct) {
            return $viewedProduct->product;
        });

        return $products;
    }

    public function getViewedCount(): int
    {
        return $this->getViewed()->count();
    }
}
