<?php

namespace App\Service;

use App\Contracts\Repository\PaymentsServiceRepositoryContract;
use App\Contracts\Service\PaymentsIntegratorServiceContract;
use App\Models\PaymentsService;
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
    }

    public function getAllPaymentsServices(): Collection
    {
        return $this->repository->getPaymentsServicesList();
    }

    public function getPaymentsServiceById(int $id): bool|PaymentsService
    {
        return $this->repository->getPaymentsServiceById($id);
    }
}
