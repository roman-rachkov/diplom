<?php

namespace App\Repository;

use App\Contracts\Repository\AdminSettingsRepositoryContract;
use App\Contracts\Repository\SellerRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Seller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SellerRepository implements SellerRepositoryContract
{
    private AdminSettingsServiceContract $adminSettings;

    public function __construct(AdminSettingsServiceContract $adminSettings)
    {
        $this->adminSettings =$adminSettings;
    }

    public function find($id)
    {
        return Cache::tags(['sellers'])
            ->remember(
            'seller' . $id,
            $this->getTtl(),
            function () use ($id) {
                return Seller::find($id);
            });
    }

    public function getAllSellers(): Collection
    {
        return Cache::tags(['sellers'])
            ->remember(
                'sellers|all',
                $this->getTtl(),
                function () {
                    return Seller::with('logo')->get();
                }
        );
    }

    protected function getTtl()
    {
        return $this->adminSettings->get('sellersCacheTime', 600);
    }
}
