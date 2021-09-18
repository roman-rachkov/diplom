<?php

namespace App\Repository;

use App\Contracts\Repository\AdminSettingsRepositoryContract;
use App\Contracts\Repository\SellerRepositoryContract;
use App\Models\Seller;
use Illuminate\Support\Facades\Cache;

class SellerRepository implements SellerRepositoryContract
{
    private $model;
    private $adminsSettings;

    public function __construct(Seller $seller, AdminSettingsRepositoryContract $adminsSettings)
    {
        $this->model = $seller;
        $this->adminsSettings = $adminsSettings;
    }

    public function find($id)
    {
        $ttl = $this->adminsSettings->get('bannerCacheTime', 600);

        $seller = Cache::tags(['sellers'])->remember('seller' . $id, $ttl, function () use ($id) {

            return $this->model->find($id);
        });
        return $seller;
    }
}
