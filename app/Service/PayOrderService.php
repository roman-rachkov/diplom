<?php

namespace App\Service;

use App\Contracts\Service\PayOrderServiceContract;

class PayOrderService implements PayOrderServiceContract
{
    public $payments = [];

    public function pay($payMethod, $cardNumber)
    {
        // send in payment queue -> job call PaymentMethod and create DB new rows id / method_name / status / error_message
        $id = count($this->payments) + 1;
        $error = rand(0, 1);
        $this->payments[$id] = [
            'method' => $payMethod,
            'status' => $error,
            'message' => $error ? "" : "Error payment status"
             ];
        return $this->getStatus($id);
    }

    public function getStatus($id)
    {
        return $this->payments[$id]['status'];
    }
}
