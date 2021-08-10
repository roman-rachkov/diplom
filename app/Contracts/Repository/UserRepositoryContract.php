<?php

namespace App\Contracts\Repository;

interface UserRepositoryContract
{
    
    public function getAdminUsers();
    
    public function find();
    
    public function store();
    
    public function update();
    
    public function delete();
    
    public function getViewedProducts();
    
    public function getOrderHistory();
    
}