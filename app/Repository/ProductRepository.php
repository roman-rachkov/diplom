<?php

namespace App\Repository;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Http\Requests\CatalogGetRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
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

    public function getProductsForCatalogByCategory(CatalogGetRequest $request, $slug)
    {
        $query = $this->model->newQuery();
        $query->FindByCategorySlug($slug);
        $query->with('prices');
        $query->with('sellers');
        $key = 'allProductsForCatalogPageByCategory_' . $slug . '_';
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
            $query->when('name', '=', $request->getSearch());
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

        return Cache::tags(['products', 'catalog', 'category'])->remember($key, $ttl,function () use($query, $itemOnPage, $currentPage) {
            return $query->paginate($itemOnPage, ['*'], 'page', $currentPage);
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
            $query->when('name', '=', $request->getSearch());
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

        return Cache::tags(['products', 'catalog'])->remember($key, $ttl,function () use($query, $itemOnPage, $currentPage) {
            return $query->paginate($itemOnPage, ['*'], 'page', $currentPage);
        });
    }

    public function getProductsByCategory(Category $category): Collection
    {
        return Product::where('category_id', $category->id)->get('id')->map(fn($item) => $item->id);
    }

    public function getSellersForProducts(int $catId)
    {
        return $this->model->where('category_id', $catId)->get()->pluck( 'sellers');
    }
}
