<?php

namespace App\Contracts\Service;

use App\Models\Order;
use App\Models\Payment;

interface PaymentServiceContract
{
    public function add(Order $order): bool|Payment;

    public function pay(int $card, Order $order): bool|Payment;

    public function render($inputs = null);

}
