<?php

namespace App\Service;

use App\Contracts\Repository\PaymentsServiceRepositoryContract;
use App\Contracts\Service\PaymentServiceContract;
use App\Contracts\Service\PaymentsIntegratorServiceContract;
use Illuminate\Support\Collection;

class PaymentsIntegratorService implements PaymentsIntegratorServiceContract
{

    public PaymentsServiceRepositoryContract $repository;

    public function __construct(PaymentsServiceRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function addPayment(float $cost): bool
    {
        // TODO: Implement addPayment() method.
        return false;
    }

    public function getAllPaymentsServices(): Collection
    {
        return $this->repository->getPaymentsServicesList();
    }

    public function getPaymentsServiceById(int $id): bool|PaymentServiceContract
    {
        return app($this->repository->getPaymentsServiceById($id)->service);
    }
}
