<?php

namespace App\Contracts\Repository;

interface BannerRepositoryContract
{
    
    public function getAdminBanners();
    
    public function store();
    
    public function update();
    
    public function delete();
    
    public function addImage();
    
}