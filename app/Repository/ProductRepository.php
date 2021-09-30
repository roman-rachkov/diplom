<?php

namespace App\Repository;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryContract
{
    private AdminSettingsServiceContract $adminsSettings;

    public function __construct(AdminSettingsServiceContract $adminsSettings)
    {
        $this->adminsSettings = $adminsSettings;
    }

    public function storeReview(Product $product, array $attributes): bool|Model
    {
        return $product->reviews()->create($attributes);
    }

    public function find($slug): Product|null
    {
        $ttl = $this->adminsSettings->get('productsCacheTime', 60 * 60 * 24);

        return Cache::tags(
            [
                'products',
                'categories',
                'reviews',
                'prices',
                'manufacturers',
                'sellers'
            ])
            ->remember($slug, $ttl, function () use ($slug) {

            return Product::with('attachment', 'prices.seller', 'category')
                ->where('slug', $slug)
                ->first();

        });
    }

    public function getAllProducts($curPage): LengthAwarePaginator
    {
        $ttl = $this->adminsSettings->get('productsInCatalogCacheTime', 60 * 60 * 24);
        $itemOnPage = $this->adminsSettings->get('productOnCatalogPage', 8);
        return Cache::tags(['products'])
            ->remember(
                'allProducts_page_' . $curPage . '_itemOnPage_' . $itemOnPage ,
                $ttl,
                function () use ($itemOnPage, $curPage) {
                    return Product::paginate($itemOnPage, ['*'], 'page', $curPage);
                });
    }

    public function getProductsForCategory($slug, $curPage): LengthAwarePaginator
    {
        $ttl = $this->adminsSettings
            ->get('productsInCatalogCacheTime', 60 * 60 * 24);
        $itemOnPage = $this->adminsSettings
            ->get('productOnCatalogPage', 8);
        return Cache::tags(['products'])
            ->remember(
                'allProductsByCat_'. $slug .'_page_' . $curPage . '_itemOnPage_' . $itemOnPage,
                $ttl,
                function() use ($slug, $itemOnPage,$curPage) {
                    return Product::FindByCategorySlug($slug)
                        ->paginate($itemOnPage, ['*'], 'page', $curPage);
                });
    }

    public function getTopProducts(): Collection
    {
        return Cache::tags(['products', 'topCatalog'])->remember(
            'mainTopCatalog',
            $this->adminsSettings->get('productsInCatalogCacheTime', 60 * 60 * 24),
            function () {
                return Product::orderBy('sort_index', 'asc')
                    ->orderBy('sales_count', 'asc')
                    ->take($this->adminsSettings->get('topProductsCount', 8))
                    ->get();
            });
    }
}
