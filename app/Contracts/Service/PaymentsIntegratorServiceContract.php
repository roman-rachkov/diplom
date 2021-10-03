<?php

namespace App\Contracts\Service;

use App\Models\Order;
use Illuminate\Support\Collection;

interface PaymentsIntegratorServiceContract
{
    public function addPayment(int $card, Order $order, PaymentServiceContract $paymentService): bool;

    public function getAllPaymentsServices(): Collection;

    public function getPaymentsServiceById(int $id): bool|PaymentServiceContract;

    public function getPaymentById(int $id);

    public function completed(int $id);

    public function canceled(int $id, string $message);

}
