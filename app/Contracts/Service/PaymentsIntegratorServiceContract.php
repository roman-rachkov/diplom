<?php

namespace App\Contracts\Service;

use App\Models\PaymentsService;
use Illuminate\Support\Collection;

interface PaymentsIntegratorServiceContract
{
    public function addPayment(float $cost): bool;

    public function getAllPaymentsServices(): Collection;

    public function getPaymentsServiceById(int $id): bool|PaymentsService;

}
