<?php

namespace App\Contracts\Service;

use Illuminate\Support\Collection;

interface PaymentsIntegratorServiceContract
{
    public function addPayment(float $cost): bool;

    public function getAllPaymentsServices(): Collection;

    public function getPaymentsServiceById(int $id): bool|PaymentServiceContract;

}
