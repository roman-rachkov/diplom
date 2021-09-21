<?php

namespace App\Repository;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Product;
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
        return Cache::tags(['products'])->remember('allProducts_page_' . $curPage . '_itemOnPage_' . $itemOnPage ,$ttl, function () use ($itemOnPage, $curPage) {
            return Product::with('prices')->paginate($itemOnPage, ['*'], 'page', $curPage);
        });
    }

    public function getProductsForCategory($slug, $curPage)
    {
        $ttl = $this->adminsSettings->get('productsInCatalogCacheTime', 60*60*24);
        $itemOnPage = $this->adminsSettings->get('productOnCatalogPage', 8);
        return Cache::tags(['products'])->remember('allProductsByCat_'. $slug .'_page_' . $curPage . '_itemOnPage_' . $itemOnPage , $ttl, function() use ($slug, $itemOnPage,$curPage) {
            return Product::FindByCategorySlug($slug)->paginate($itemOnPage, ['*'], 'page', $curPage);
        });
    }
}
