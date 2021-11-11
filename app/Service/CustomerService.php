<?php

namespace App\Service;

use App\Contracts\Repository\CustomerRepositoryContract;
use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Models\Customer;
use Illuminate\Support\Facades\Cache;
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
        if (Cookie::get('customer_token')) {
            if (auth()->user()) {
                return auth()->user()->customer;
//                return Cache::tags(['customerService'])->remember(
//                    'customerService_user_id_' . auth()->user()->id, 60 * 60 * 24, function () {
//                    return auth()->user()->customer;
//                });
            } else {
                return $this->repository->getByHash(Cookie::get('customer_token'));
            }
        } else {
            $customer = $this->repository->createCustomer();
            Cookie::queue('customer_token', $customer->hash);
            return $customer;
        }
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


    public function associateCart(OrderItemRepositoryContract $orderItemRepo)
    {

        $cartCollection = $this->repository->getCustomerCartByHash(Cookie::get('non_auth_customer_token'));
        $customerId = $this->getCustomer()->id;
        $orderItemRepo->chengeCutomerId($cartCollection, $customerId);

    }

    public function associateComparedProducts(OrderItemRepositoryContract $orderItemRepo)
    {

    }

}
