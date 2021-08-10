<?php

namespace App\Contracts\Service;

interface PayServiceContract
{
    public function pay($payMethod, $cardNumber);
}