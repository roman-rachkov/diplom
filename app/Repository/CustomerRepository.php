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

    public function getByHash($hash)
    {
        $customer = $this->model->firstOrCreate(['hash' => $hash]);;
        if ($customer->hash === null) {
            $customer->hash = hash('sha256', $customer);
            $customer->save();
        }
        return $customer;
    }

}
