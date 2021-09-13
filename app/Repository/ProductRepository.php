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

    public function getAllProducts($curPage)
    {
        $ttl = $this->adminsSettings->get('productsInCatalogCacheTime', 60*60*24);
        $itemOnPage = $this->adminsSettings->get('productOnCatalogPage', 8);
        return Cache::tags(['products'])->remember('allProducts_page_' . $curPage ,$ttl, function () use ($itemOnPage) {
            return Product::paginate($itemOnPage);
        });
    }

    public function getProductsForCategory($catId, $curPage)
    {
        $ttl = $this->adminsSettings->get('productsInCatalogCacheTime', 60*60*24);
        $itemOnPage = $this->adminsSettings->get('productOnCatalogPage', 8);
        return Cache::tags(['products'])->remember('allProductsByCat_'. $catId .'_page_' . $curPage , $ttl, function() use ($catId, $itemOnPage) {
            return Product::where('category_id', $catId)->paginate($itemOnPage);
        });
    }
}
