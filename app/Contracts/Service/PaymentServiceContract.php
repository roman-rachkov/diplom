<?php

namespace App\Contracts\Service;

interface PaymentServiceContract
{
    public function add(): bool;

    public function cancel(): bool;

    public function complete(): bool;
}
