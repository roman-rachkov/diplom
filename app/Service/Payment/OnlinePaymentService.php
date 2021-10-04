<?php

namespace App\Service\Payment;

class OnlinePaymentService extends AbstractPaymentService
{
    protected string $class = '\\' . __CLASS__;

    public function render($inputs = null)
    {
        return view('payment.online')->with($inputs);
    }

    public function namespace(): string
    {
        return $this->class;
    }
}
