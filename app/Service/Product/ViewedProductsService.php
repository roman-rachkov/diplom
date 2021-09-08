<?php

namespace App\Service\Product;

use App\Contracts\Service\Product\ViewedProductsServiceContract;
use App\Models\Product;
use App\Models\ViewedProduct;
use Illuminate\Database\Eloquent\Collection;

class ViewedProductsService implements ViewedProductsServiceContract
{
    
    public function add(Product $product): bool
    {
        return (bool)rand(1,0);
    }
    
    public function remove(Product $product): bool
    {
        return (bool)rand(1,0);
    }
    
    public function isViewed(Product $product): bool
    {
        return (bool)rand(1,0);
    }
    
    public function getViewed(): Collection
    {
        return ViewedProduct::factory(rand(3,10))->make();
    }
    
    public function getViewedCount(): int
    {
        return rand(3,10);
    }
    
}