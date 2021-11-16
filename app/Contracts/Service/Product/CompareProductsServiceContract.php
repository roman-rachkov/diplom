<?php

namespace App\Contracts\Service\Product;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Collection;


interface CompareProductsServiceContract
{
    public function add(Product $product, Customer $customer): bool;

    public function remove(Product $product, Customer $customer): bool;

    public function get(Customer $customer, int $quantity = 3): Collection;

    public function getCount(Customer $customer): int;
}
