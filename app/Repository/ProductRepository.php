<?php

namespace App\Repository;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryContract
{
    public function __construct(AdminSettingsServiceContract $adminsSettings)
    {
        $this->adminsSettings = $adminsSettings;
    }

    public function getAllProducts($currentPage = 1)
    {

        $ttl = $this->adminsSettings->get('productsInCatalogCacheTime', 60*60*24);

        return Cache::tags(['products'])->remember('allProducts',$ttl, function ($perPage, $currentPage) {
            return Product::all();
        });
    }
}
