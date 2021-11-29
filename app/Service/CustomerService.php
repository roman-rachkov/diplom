<?php

namespace App\Service;

use App\Contracts\Repository\CompareProductsRepositoryContract;
use App\Contracts\Repository\CustomerRepositoryContract;
use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Repository\ViewedProductsRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Models\Customer;
use Illuminate\Support\Facades\Cache;
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
        return Cache::store('array')->rememberForever('customerService', function () {

            if (!Cookie::get('customer_token')) {
                $customer = $this->repository->createCustomer();
                Cookie::queue('customer_token', $customer->hash);
                return $customer;
            }

            if (auth()->user() && auth()->user()->customer) {
                return auth()->user()->customer;
            }

            if (auth()->user() && !auth()->user()->customer) {
                $this->repository->setUserId(Cookie::get('customer_token'), auth()->user()->id);
            }

            $customer = $this->repository->getByHash(Cookie::get('customer_token'));

            if ($customer === null) {
                $customer = $this->repository->createCustomer();
            }

            return $customer;
        });
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


    public function associateCart(OrderItemRepositoryContract $orderItemRepo, $hash)
    {

        $cartCollection = $this->repository->getCustomerCartByHash($hash);
        $customerAuth = $this->getCustomer();
        $orderItemRepo->chengeCutomerId($cartCollection, $customerAuth->id);
    }

    public function associateComparedProducts(CompareProductsRepositoryContract $compareRepo, $hash)
    {
        $customerFromCookieId = $this->getCustomerByHash($hash)->id;
        $customerAuthId = $this->getCustomer()->id;
        $compareRepo->chengeCutomerId($customerAuthId, $customerFromCookieId);
    }

    public function associateViewedProducts(ViewedProductsRepositoryContract $viewedRepo, $hash)
    {
        $customerFromCookieId = $this->getCustomerByHash($hash)->id;
        $customerAuthId = $this->getCustomer()->id;
        $viewedRepo->chengeCutomerId($customerAuthId, $customerFromCookieId);
    }

    public function changeCookieHash()
    {
        Cookie::queue('customer_token', $this->getCustomer()->hash);
    }

    public function removeCustomerBuHash($hash)
    {
        $this->repository->removeCustomerByHash($hash);
    }

}
