<?php

namespace App\Service\Payment;

use App\Contracts\Repository\PaymentRepositoryContract;
use App\Contracts\Repository\PaymentsServiceRepositoryContract;
use App\Contracts\Service\PaymentServiceContract;
use App\Models\Order;
use App\Models\Payment;

abstract class AbstractPaymentService implements PaymentServiceContract
{

    private PaymentRepositoryContract $paymentRepository;
    private PaymentsServiceRepositoryContract $paymentsServiceRepository;

    public function __construct(
        PaymentRepositoryContract         $paymentRepository,
        PaymentsServiceRepositoryContract $paymentsServiceRepository
    )
    {
        $this->paymentRepository = $paymentRepository;
        $this->paymentsServiceRepository = $paymentsServiceRepository;
    }

    public function add(Order $order): bool|Payment
    {
        return $this->paymentRepository->add(
            $order,
            $this->paymentsServiceRepository->getPaymentsServiceByService('\\' . __CLASS__)
        );
    }

    public function cancel(): bool
    {
        // TODO: Implement cancel() method.
        return false;
    }

    public function complete(): bool
    {
        // TODO: Implement complete() method.
        return false;
    }
}
