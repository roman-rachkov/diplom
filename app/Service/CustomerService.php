<?php

namespace App\Service;

use App\Contracts\Service\CustomerServiceContract;
use App\Models\Customer;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class CustomerService implements CustomerServiceContract
{

    public function getCustomer(): Customer
    {
        $user = auth()->user();

        if ($user) {
            $customer = $user->customer;
        } else {
            $customer = Customer::firstWhere('hash', Cookie::get('customer_token'));
        }

        if (! $customer) {
            Log::error('The User is not related to the Customer');
            abort(500, 'The User is not related to the Customer');
        }

        return $customer;
    }
}
