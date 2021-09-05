<?php

namespace App\Service;

use App\Contracts\Service\PayOrderServiceContract;

class PayOrderService implements PayOrderServiceContract
{
    public $payments = [];

    /**
     * @param string $payMethod
     * @param int $cardNumber
     * @return array|mixed
     */
    public function pay(string $payMethod, int $cardNumber): string
    {
        return __('payment.add_payment');
    }

    /**
     * @param int $id
     * @return array|mixed
     */
    public function getStatus(int $id): array
    {
        if (rand(0, 1)) {
            return ['status' => 1];
        } else {
            return ['status' => 0, 'error' => 'Payment system error'];
        }
    }
}
