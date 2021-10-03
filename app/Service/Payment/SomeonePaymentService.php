<?php

namespace App\Service\Payment;

class SomeonePaymentService extends AbstractPaymentService
{
    protected string $class = '\\' . __CLASS__;

    public function render($inputs = null)
    {
        return view('payment.someone')->with($inputs);
    }
}
