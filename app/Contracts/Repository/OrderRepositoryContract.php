<?php

namespace App\Contracts\Repository;

interface OrderRepositoryContract
{
    
    public function getAdminOrders();
    
    public function find();
    
    public function store();
    
    public function update();
    
    public function addItems();
    
    public function addDelivery();
    
    public function addPayment();
    
    public function addUser();
    
}