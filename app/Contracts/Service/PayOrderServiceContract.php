<?php

namespace App\Contracts\Service;

interface PayOrderServiceContract
{
    /**
     * @param string $payMethod
     * @param int $cardNumber
     * @return array
     */
    public function pay(string $payMethod, int $cardNumber): string;

    /**
     * @param int $paymentId
     * @return array
     */
    public function getStatus(int $paymentId): array;
}
