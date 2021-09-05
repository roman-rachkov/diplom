<?php

namespace App\Contracts\Service;

interface PayOrderServiceContract
{
    public function pay($payMethod, $cardNumber);

    public function getStatus($paymentId);
}
