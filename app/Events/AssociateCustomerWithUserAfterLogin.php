<?php

namespace App\Events;

use App\Contracts\Service\CustomerServiceContract;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssociateCustomerWithUserAfterLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CustomerServiceContract $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->customer()->save($this->customer->getCustomer());
    }
}
