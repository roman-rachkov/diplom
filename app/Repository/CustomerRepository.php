<?php

namespace App\Repository;

use App\Contracts\Repository\CustomerRepositoryContract;
use App\Models\Customer;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

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

    public function setUserId($hash, $userId)
    {
        $item = $this->model->where(['hash' => $hash])->first();
        $item->update(['user_id' => $userId]);
    }

}
