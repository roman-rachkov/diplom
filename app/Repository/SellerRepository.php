<?php

namespace App\Repository;

use App\Contracts\Repository\SellerRepositoryContract;
use App\Models\Seller;

class SellerRepository implements SellerRepositoryContract
{
    public $model;

    public function __construct(Seller $seller)
    {
        $this->model = $seller;
    }

    public function find($id)
    {
        $seller = cache()->tags(['sellers'])->remember('seller' . $id, 600, function () use ($id) {

            return $this->model->find($id);
        });
        return $seller;
    }
}
