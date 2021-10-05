<?php

namespace App\Service\Payment;

use App\Contracts\Repository\PaymentRepositoryContract;
use App\Contracts\Repository\PaymentsServicesRepositoryContract;
use App\Contracts\Service\PaymentServiceContract;
use App\Contracts\Service\PaymentsIntegratorServiceContract;
use App\Jobs\GoPaymentJob;
use App\Models\Order;
use Illuminate\Support\Collection;

class PaymentsIntegratorService implements PaymentsIntegratorServiceContract
{

    public PaymentsServicesRepositoryContract $repository;
    private PaymentRepositoryContract $payment;

    public function __construct(PaymentsServicesRepositoryContract $repository, PaymentRepositoryContract $payment)
    {
        $this->repository = $repository;
        $this->payment = $payment;
    }

    public function addPayment(int $card, Order $order, PaymentServiceContract $paymentService): bool
    {
        $service = $this->repository->getPaymentsServiceByService($paymentService->namespace());
        $payment = $this->payment->add($order, $service);
        GoPaymentJob::dispatch(
            $card,
            $payment,
            $paymentService
        );
        return true;
    }

    public function getAllPaymentsServices(): Collection
    {
        return $this->repository->getPaymentsServicesList();
    }

    public function getPaymentsServiceById(int $id): bool|PaymentServiceContract
    {
        return app($this->repository->getPaymentsServiceById($id)->service);
    }

    public function getPaymentById(int $id)
    {
        return $this->payment->getPaymentById($id);
    }

    public function canceled(int $id, string $message)
    {
        return $this->payment->cancel($id, $message);
    }

    public function completed(int $id)
    {
        return $this->payment->complete($id);
    }

}
