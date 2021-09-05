<?php

namespace App\Contracts\Service;

use App\Models\Product;

interface ViewedProductsServiceContract
{
    
    public function add(Product $product);
    
    public function remove(Product $product);
    
    public function isViewed(Product $product);
    
    public function getViewed();
    
    public function getViewedCount();
    
}