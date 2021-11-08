<?php

namespace App\Service;

use App\Contracts\Repository\CustomerRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Models\Customer;
use Illuminate\Support\Facades\Cookie;

class CustomerService implements CustomerServiceContract
{
    private $repository;

    public function __construct(CustomerRepositoryContract $repo)
    {
        $this->repository = $repo;
    }

    public function getCustomer(): Customer
    {
        if (auth()->user()) {
            $customer = auth()->user()->customer;
        } else {
            $customer = $this->repository->getByHash(Cookie::get('customer_token'));
        }
        Cookie::queue(Cookie::forever('customer_token', $customer->hash));
        return $customer;
    }

}
