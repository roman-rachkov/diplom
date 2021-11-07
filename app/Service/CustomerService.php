<?php

namespace App\Service;

use App\Contracts\Repository\CustomerRepositoryContract;
use App\Contracts\Service\Cart\AddCartServiceContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\Cart\RemoveCartServiceContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Models\Customer;
use App\Service\Cart\AddCartService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

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
            if (auth()->user()->customer) {
                $customer = auth()->user()->customer;
            } else {
                $customer = $this->repository->getByHash(Cookie::get('customer_token'));
                Cookie::queue(Cookie::forever('customer_token', $customer->hash));
            }
        } else {
            $customer = $this->repository->getByHash(Cookie::get('customer_token'));
            Cookie::queue(Cookie::forever('customer_token', $customer->hash));
            Cookie::queue(Cookie::forever('non_auth_customer_token', $customer->hash));
        }
        return $customer;
    }

    public function getCustomerByHash($hash)
    {
        return $this->repository->getByHash($hash);
    }

    public function getCustomerHash(): string
    {
        return $this->getCustomer()->hash;
    }

    public function associateWithUser($userId)
    {
        return $this->repository->setUserId($this->getCustomerHash(), $userId);
    }


    public function associateCart()
    {
        $customer = $this->getCustomer();
        $otherCustomer = $this->getCustomerByHash(Cookie::get('non_auth_customer_token'));

        dd($otherCustomer->cart);

        return true;
    }

}
