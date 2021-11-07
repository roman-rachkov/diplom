<?php

namespace App\Events;

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
    public function __construct(CustomerServiceContract $customerService)
    {
        $this->customer = $customerService;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if (Cookie::get('non_auth_customer_token') === $this->customer->getCustomerHash() ? 'true' : 'false') {
            Log::info('hash difference true');
        }

        $this->customer->associateWithUser($event->user->id);
    }
}
