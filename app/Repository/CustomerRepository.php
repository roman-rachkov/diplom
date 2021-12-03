<?php

namespace App\Repository;

use App\Contracts\Repository\CustomerRepositoryContract;
use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Models\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CustomerRepository implements CustomerRepositoryContract
{
    private $model;

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    public function getByHash($hash): ?Customer
    {
        return Cache::tags(['customerService'])->remember(
            'customerService_user_id_' . $hash, 60 * 60 * 24, function () use ($hash) {
            return $this->model->firstWhere('hash', $hash);
        });
    }

    public function createCustomer($hash = null)
    {
        $newHash = $hash ?? hash('sha256', Str::random(256));
        if ($hash) Cache::tags(['customerService'])->flush();
        return Cache::tags(['customerService'])->remember(
            'customerService_user_id_' . $newHash, 60 * 60 * 24, function () use ($newHash) {
            $customer = $this->model->create();
            $customer->hash = $newHash;
            $customer->save();
            return $customer;
        });
    }

    public function setUserId($hash, $userId)
    {
        $item = $this->model->where(['hash' => $hash])->first();
        $item->update(['user_id' => $userId]);
        return $item;
    }

    public function getCustomerCartByHash($hash): Collection
    {
        return app(OrderItemRepositoryContract::class)->getCartByCustomer($this->getByHash($hash));
    }

    public function removeCustomerByHash($hash)
    {
        $this->model->where(['hash' => $hash])->delete();
    }

    public function checkIsNotCustomerInDb($hash)
    {
        if (is_null($this->model->where(['hash' => $hash])->first())) {
            return true;
        }
        return false;
    }

}
