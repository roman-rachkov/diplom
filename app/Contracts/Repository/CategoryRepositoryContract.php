<?php

namespace App\Contracts\Repository;

interface CategoryRepositoryContract
{
    
    public function getAdminCategories();
    
    public function store();
    
    public function update();
    
    public function addImage();
    
}