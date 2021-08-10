<?php

namespace App\Contracts\Repository;

interface ProductRepositoryContract
{
    
    public function getProducts();
    
    public function getAdminProducts();
    
    public function find();
    
    public function store();
    
    public function update();
    
    public function delete();
    
    public function addReview();
    
    public function addSeller();
    
    public function addManufacturer();
    
    public function addCategory();
    
    public function addMainImage();
    
    public function addGalleryImage();
    
}