<?php

namespace App\Events;

use App\Contracts\Repository\CompareProductsRepositoryContract;
use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Repository\ViewedProductsRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AssociateCustomerWithUserAfterLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        CustomerServiceContract $customerService,
        OrderItemRepositoryContract $orderItemRepo,
        CompareProductsRepositoryContract $comparedRepo,
        ViewedProductsRepositoryContract $viewedRepo
    )
    {
        $this->customerServece = $customerService;
        $this->orederItemRepo = $orderItemRepo;
        $this->comparedRepo = $comparedRepo;
        $this->viewedRepo = $viewedRepo;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $cookieHash = Cookie::get('customer_token');
        if ($this->customerServece->getCustomer()->hash !== $this->customerServece->getCustomerByHash($cookieHash)->hash) {
            $this->customerServece->associateComparedProducts($this->comparedRepo, $cookieHash);
            $this->customerServece->associateViewedProducts($this->viewedRepo, $cookieHash);
            $this->customerServece->associateCart($this->orederItemRepo, $cookieHash);
            $this->customerServece->changeCookieHash($cookieHash);
            $this->customerServece->removeCustomerBuHash($cookieHash);
        }
    }
}
