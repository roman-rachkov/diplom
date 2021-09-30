<?php

namespace App\Contracts\Repository;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentsService;

interface PaymentRepositoryContract
{
    public function add(Order $order, PaymentsService $service): Payment;

    public function getPaymentById(int $id): bool|Payment;

    public function setStatus(int $paymentId, string $status): bool;
}
