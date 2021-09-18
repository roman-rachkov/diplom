<?php

namespace App\Service;

use App\Contracts\Service\FlashMessageServiceContract;

class FlashMessageService implements FlashMessageServiceContract
{
    
    public function flash(string $message, string $type = 'success')
    {
        $alert = (object)[];
        $alert->message = $message;
        $alert->type = $type;
        session()->flash('alert', $alert);
    }
}