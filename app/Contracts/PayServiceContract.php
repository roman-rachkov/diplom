<?php

namespace App\Contracts;

interface PayServiceContract
{
    public function pay($payMethod, $cardNumber);
}