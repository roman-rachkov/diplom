<?php

namespace App\Repository;

use App\Contracts\Repository\CompareProductsRepositoryContract;
use App\Models\ComparedProduct;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class CompareProductsRepository implements CompareProductsRepositoryContract
{
    
    public function store(Product $product, Customer $customer): bool
    {
        try {
          return (new ComparedProduct(
                [
                    'product_id' => $product->id,
                    'customer_id' => $customer->id
                ]
            ))->save();
        } catch (QueryException $e) {
            return false;
        }
    }
    
    public function delete(Product $product, Customer $customer): bool
    {
        return ComparedProduct::where('product_id', $product->id)
            ->where('customer_id', $customer->id)
            ->get()
            ->first()
            ->delete();
    }
    
    public function getComparedProducts(Customer $customer): Collection
    {
        return ComparedProduct::where('customer_id', $customer->id)->get();
    }
    
}