<?php

namespace App\Contracts\Service;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Collection;

interface PaymentsIntegratorServiceContract
{
    public function addPayment(int $card, Order $order, PaymentServiceContract $paymentService): bool|Payment;

    public function getAllPaymentsServices(): Collection;

    public function getPaymentsServiceById(int $id): bool|PaymentServiceContract;

    public function getPaymentById(int $id);

    public function completed(int $id);

    public function canceled(int $id, string $message);

}
