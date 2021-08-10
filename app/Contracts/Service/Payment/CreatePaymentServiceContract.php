<?php

namespace App\Contracts\Service\Payment;

interface CreatePaymentServiceContract
{
    public function create(array $attributes);
}