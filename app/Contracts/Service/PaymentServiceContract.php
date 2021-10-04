<?php

namespace App\Contracts\Service;

use App\Models\Order;
use App\Models\Payment;

interface PaymentServiceContract
{
    public function pay(int $card, Payment $payment): bool;

    public function render($inputs = null);

    public function namespace(): string;

}
