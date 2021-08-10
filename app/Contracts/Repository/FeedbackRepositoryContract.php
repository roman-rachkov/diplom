<?php

namespace App\Contracts\Repository;

interface FeedbackRepositoryContract
{
    
    public function getAdminFeedbacks();
    
    public function update();
    
}