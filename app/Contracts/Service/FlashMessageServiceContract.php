<?php

namespace App\Contracts\Service;

interface FlashMessageServiceContract
{

    public function flash(string $message, string $type = 'success');
    
}