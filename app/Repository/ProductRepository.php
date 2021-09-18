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

        return Cache::tags(['products', 'categories', 'reviews', 'prices', 'manufacturers', 'sellers'])->remember($slug,$ttl,function () use ($slug) {

            return Product::with('attachment', 'prices.seller')->where('slug', $slug)->first();

        });
    }

    public function getAllProducts($curPage)
    {
        $ttl = $this->adminSettings->get('productsInCatalogCacheTime', 60*60*24);
        $itemOnPage = $this->adminSettings->get('productOnCatalogPage', 8);
        return Cache::tags(['products'])->remember('allProducts_page_' . $curPage . '_itemOnPage_' . $itemOnPage ,$ttl, function () use ($itemOnPage, $curPage) {
            return Product::paginate($itemOnPage, ['*'], 'page', $curPage);
        });
    }

    public function getProductsForCategory($slug, $curPage)
    {
        $ttl = $this->adminSettings->get('productsInCatalogCacheTime', 60*60*24);
        $itemOnPage = $this->adminSettings->get('productOnCatalogPage', 8);
        return Cache::tags(['products'])->remember('allProductsByCat_'. $slug .'_page_' . $curPage . '_itemOnPage_' . $itemOnPage , $ttl, function() use ($slug, $itemOnPage,$curPage) {
            return Product::FindByCategorySlug($slug)->paginate($itemOnPage, ['*'], 'page', $curPage);
        });
    }
}