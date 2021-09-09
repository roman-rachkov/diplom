<?php

namespace App\Contracts\Service\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ViewedProductsServiceContract
{
    
    public function add(Product $product): bool;
    
    public function remove(Product $product): bool;
    
    public function isViewed(Product $product): bool;
    
    public function getViewed(): Collection;
    
    public function getViewedCount(): int;
    
}