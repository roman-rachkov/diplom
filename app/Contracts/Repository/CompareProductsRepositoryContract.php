<?php

namespace App\Contracts\Repository;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Collection;

interface CompareProductsRepositoryContract
{

    public function store(Product $product, Customer $customer): bool;

    public function delete(Product $product, Customer $customer): bool;

    public function getComparedProducts(Customer $customer): Collection;
    
    public function getComparedProductsCount(Customer $customer):int;
    
}