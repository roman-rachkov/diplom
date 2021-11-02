<?php

namespace App\Repository;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Http\Requests\CatalogGetRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
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

    public function storeReview(Product $product, array $attributes): Model
    {
        return $product->reviews()->create($attributes);
    }

    public function getProductsForCatalogByCategory(CatalogGetRequest $request, $slug = '')
    {
        $key = 'allProductsForCatalogPage_';
        $query = $this->model->newQuery();

        if ($slug) {
            $key .= 'byCategory_' . $slug . '_';
            $query->FindByCategorySlug($slug);
        }

        $query->with('prices');
        $query->with('sellers');
        $ttl = $this->adminsSettings->get('productsInCatalogCacheTime', 60 * 60 * 24);
        $itemOnPage = $this->adminsSettings->get('productOnCatalogPage', 8);
        $currentPage = $request->getCurrentPage();
        $key .= 'page_' . $request->getCurrentPage();

        if ($request->getMinPrice() || $request->getMaxPrice()) {
            $key .= '_price-range_' . $request->getMinPrice() . '-' . $request->getMaxPrice();
            $query->whereHas('prices', function ($q) use ($request) {
                return $q->whereBetween('price', [$request->getMinPrice(), $request->getMaxPrice()]);
            });
        }

        if ($request->getSeller()) {
            $key .= '_seller_' . $request->getSeller();
            $query->whereHas('sellers', function ($q) use ($request) {
                return $q->where('id', $request->getSeller());
            });
        }


        if ($request->getSearch()) {
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

        return Cache::tags(['products', 'catalog', 'category'])->remember($key, $ttl, function () use ($query, $itemOnPage, $currentPage) {
            return $query->paginate($itemOnPage, ['*'], 'page', $currentPage);
        });
    }

    public function find($slug): Product
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

                return Product::with('attachment', 'prices.seller')
                    ->where('slug', $slug)
                    ->first();

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

    public function getProductsByCategory(Category $category): Collection
    {
        return $this->model->where('category_id', $category->id)->get('id')->map(fn($item) => $item->id);
    }

    public function getSellersForProducts(int $catId): Collection
    {
        return $this->model->where('category_id', $catId)->get()->pluck('category');
    }

    public function getDayOfferProduct(): Product
    {
        $now = Carbon::now();
        $tomorrow = Carbon::tomorrow();
        $key = 'dayOfferForBetweenDays_' . $now->dayOfYear . '_' . $tomorrow->dayOfYear;
        return Cache::tags(['products', 'topCatalog'])->remember($key, $now->diffInSeconds($tomorrow),
            function () {
                return $this->model->where('limited_edition', 1)->inRandomOrder()->limit(1)->first();
            });
    }

    public function getLimitedEditionProduct($excludeId = null): Collection
    {
        $now = Carbon::now();
        $tomorrow = Carbon::tomorrow();
        $itemOnPage = $this->adminsSettings->get('itemsInLimitedEditionBlock', 16);
        $key = 'limitedEditionForBetweenDays_' . $now->dayOfYear . '_' . $tomorrow->dayOfYear . '_exclude_' . $excludeId;
        $key = '_ItemOnPage_' . $itemOnPage;
        return Cache::tags(['products', 'topCatalog'])->remember($key, $now->diffInSeconds($tomorrow),
            function () use ($excludeId, $itemOnPage) {
                return $this->model
                    ->where('limited_edition', 1)
                    ->whereNotIn('id', [$excludeId])
                    ->inRandomOrder()
                    ->limit($itemOnPage)
                    ->get();
            });
    }
}
