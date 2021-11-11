<?php

namespace App\Repository;

use App\Contracts\Repository\CustomerRepositoryContract;
use App\Models\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
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
        return Cache::tags(['customerService'])->remember(
            'customerService_user_id_' . $hash, 60 * 60 * 24, function () use ($hash) {
            return $this->model->firstWhere('hash', $hash);
        });
    }

    public function createCustomer()
    {
        $hash = hash('sha256', Customer::class);
        return Cache::tags(['customerService'])->remember(
            'customerService_user_id_' . $hash, 60 * 60 * 24, function () use ($hash) {
            $customer = $this->model->create();
            $customer->hash = $hash;
            $customer->save();
            return $customer;
        });
    }

    public function setUserId($hash, $userId)
    {
        $item = $this->model->where(['hash' => $hash])->first();
        return $item->update(['user_id' => $userId]);
    }

    public function getCustomerCartByHash($hash): Collection
    {
        return $this->getByHash($hash)->cart;
    }

    public function removeCustomerByHash($hash)
    {
        $this->model->where(['hash' => $hash])->delete();
    }

}
