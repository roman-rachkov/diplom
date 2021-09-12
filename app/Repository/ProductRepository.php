<?php

namespace App\Repository;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryContract
{
    private AdminSettingsServiceContract $adminSettings;

    public function __construct(AdminSettingsServiceContract $adminSettings)
    {
        $this->adminSettings = $adminSettings;
    }

    public function find($slug): Product
    {
        $ttl = $this->adminSettings->get('productsCacheTime', 60*60*24);

        return Cache::tags(['products'])->remember($slug,$ttl,function () use ($slug) {

            return Product::with('attachment')->where('slug', $slug)->first();

        });
    }

}