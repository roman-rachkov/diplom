<?php

namespace App\Events;

use App\Contracts\Repository\OrderItemRepositoryContract;
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
    public function __construct(CustomerServiceContract $customerService, OrderItemRepositoryContract $orderItemRepo)
    {
        $this->customer = $customerService;
        $this->orederItemRepo = $orderItemRepo;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        dd($event->user->id);
        $this->customer->associateWithUser($event->user->id);
//        $this->customer->associateCart($this->orederItemRepo);


    }
}
