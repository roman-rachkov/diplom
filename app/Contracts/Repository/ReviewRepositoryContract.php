<?php

namespace App\Contracts\Repository;

interface ReviewRepositoryContract
{
    
    public function getAdminReviews();
    
    public function store();
    
}