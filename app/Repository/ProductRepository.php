<?php

namespace App\Repository;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Http\Requests\CatalogGetRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryContract
{
    private $model;
    private $adminsSettings;

    public function __construct(Product $product, AdminSettingsServiceContract $adminsSettings)
    {
        $this->model = $product;
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

    public function getProductsForCatalog(CatalogGetRequest $request)
    {
        $query = $this->model->newQuery();
        $query->with('prices');
        $query->with('sellers');
        $key = 'allProductsForCatalogPage_';
        $ttl = $this->adminsSettings->get('productsInCatalogCacheTime', 60*60*24);
        $itemOnPage = $this->adminsSettings->get('productOnCatalogPage', 8);
        $currentPage = $request->getCurrentPage();
        $key .= 'page_' . $request->getCurrentPage();

        if($request->getMinPrice() || $request->getMaxPrice()) {
            $key .= '_price-range_' . $request->getMinPrice() . '-' . $request->getMaxPrice();
            $query->whereHas('prices', function ($q) use ($request) {
                return $q->whereBetween('price', [$request->getMinPrice(), $request->getMaxPrice()]);
            });
        }

        if($request->getSeller()) {
            $key .= '_seller_' . $request->getSeller();
            $query->whereHas('sellers', function ($q) use ($request) {
                return $q->where('id', $request->getSeller());
            });
        }


        if($request->getSearch()) {
            $key .= '_search_' . $request->getSearch();
            $query->where('name', '=', $request->getSearch());
        }

        if ($request->getOrderBy()) {
            $key .= '_order_by_' . $request->getOrderBy() . '_order_direction' . $request->getOrderDirection();
            if ($request->getOrderBy() == 'price') {
                $query->with('prices', function ($q) use ($request) {
                    return $q->orderBy($request->getOrderBy(), $request->getOrderDirection());
                });
            } else {
                $query->orderBy($request->getOrderBy(), $request->getOrderDirection());
            }
        }

        return $query->paginate($itemOnPage, ['*'], 'page', $currentPage);
    }

}
