<?php

namespace App\Repository;

use App\Contracts\Repository\CustomerRepositoryContract;
use App\Models\Customer;
use Illuminate\Support\Facades\Cookie;

class CustomerRepository implements CustomerRepositoryContract
{
    private $model;

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    public function getByHash()
    {
        $customer = $this->model->firstOrCreate(['hash' => Cookie::get('customer_token')]);;
        if ($customer->hash === null) {
            $customer->hash = hash('sha256', $customer);
            Cookie::queue(Cookie::forever('customer_token', $customer->hash));
            $customer->save();
        }
        return $customer;
    }

}
