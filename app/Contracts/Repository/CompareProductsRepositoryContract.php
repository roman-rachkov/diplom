<?php

namespace App\Contracts\Repository;

interface CompareProductsRepositoryContract
{
    
    public function store();
    
    public function delete();
    
    public function getComparedProducts();
    
    public function getComparedProductsCount();
    
}