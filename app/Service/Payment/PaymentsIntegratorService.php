<?php

namespace App\Service\Payment;

use App\Contracts\Repository\PaymentRepositoryContract;
use App\Contracts\Repository\PaymentsServicesRepositoryContract;
use App\Contracts\Service\PaymentServiceContract;
use App\Contracts\Service\PaymentsIntegratorServiceContract;
use App\Jobs\GoPaymentJob;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Collection;

class PaymentsIntegratorService implements PaymentsIntegratorServiceContract
{

    public PaymentsServicesRepositoryContract $repository;
    private PaymentRepositoryContract $paymentRepository;

    public function __construct(PaymentsServicesRepositoryContract $repository, PaymentRepositoryContract $paymentRepository)
    {
        $this->repository = $repository;
        $this->paymentRepository = $paymentRepository;
    }

    public function addPayment(int $card, Order $order, PaymentServiceContract $paymentService, Payment $payment = null): bool|Payment
    {
        if(!$payment) {
            $service = $this->repository->getPaymentsServiceByService($paymentService->namespace());
            $payment = $this->paymentRepository->add($order, $service);
        }
        GoPaymentJob::dispatch(
            $card,
            $payment,
            $paymentService
        );
        return $payment;
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
        return $this->paymentRepository->getPaymentById($id);
    }

    public function canceled(int $id, string $message)
    {
        return $this->paymentRepository->cancel($id, $message);
    }

    public function completed(int $id)
    {
        return $this->paymentRepository->complete($id);
    }

}
