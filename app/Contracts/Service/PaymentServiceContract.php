<?php

namespace App\Contracts\Service;

use App\Models\Order;
use App\Models\Payment;

interface PaymentServiceContract
{
    public function add(Order $order): bool|Payment;

    public function cancel(): bool;

    public function complete(): bool;

    public function render();
}
