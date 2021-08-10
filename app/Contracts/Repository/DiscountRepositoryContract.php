<?php

namespace App\Contracts\Repository;

interface DiscountRepositoryContract
{
    
    public function getAdminDiscounts();
    
    public function getDiscounts();
    
    public function find();
    
    public function store();
    
    public function update();
    
    public function addCategory();
    
    public function addProductsGroup();
    
    public function addProduct();
    
}