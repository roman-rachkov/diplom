<?php

namespace App\Service;

use App\Contracts\Repository\CustomerRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Models\Customer;

class CustomerService implements CustomerServiceContract
{
    private $repository;

    public function __construct(CustomerRepositoryContract $repo)
    {
        $this->repository = $repo;
    }

    public function getCustomer(): Customer
    {
        return auth()->user()->customer ?? $this->repository->getByHash();
    }

}
