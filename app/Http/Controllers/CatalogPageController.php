<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\PriceRepositoryContract;
use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Repository\SellerRepositoryContract;
use App\Contracts\Service\AddToCartServiceContract;
use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogPageController extends Controller
{
    public function index(ProductRepositoryContract $repo,
                          ProductDiscountServiceContract $discountRepo,
                          PriceRepositoryContract $prices,
                          SellerRepositoryContract $sellers,
                          Request $request)
    {
        $sellers = $sellers->getAllSellers();
        $curPage = $request->get('page') ?? 1;
        $products = $repo->getAllProducts($curPage);
        $discounts = $discountRepo->getCatalogDiscounts(collect($products->items()));
        $minPrice = $prices->getMinPrice();
        $maxPrice = $prices->getMaxPrice();

        return view('catalog', compact(
            'products', 'discounts', 'sellers',
            'maxPrice', 'minPrice', 'request',
        ));
    }

    public function getProductForCatalogByCategorySlug(ProductRepositoryContract $repo, Request $request, $slug)
    {
        $curPage = $request->get('page') ?? 1;
        $products = $repo->getProductsForCategory($slug, $curPage);
        return view('catalog', compact('products'));
    }

    public function addToCart(AddToCartServiceContract $addToCart, Product $product)
    {
        if ($addToCart->add($product, 1)) {
            return back()->with('success', __('catalog.success.product_add_cart'));
        } else {
            return back()->with('error', __('catalog.error.product_add_cart'));
        }
    }

    public function compare(CompareProductsServiceContract $compare, Product $product)
    {
        if ($compare->add($product)) {
            return back()->with('success', __('catalog.success.product_add_compare'));
        } else {
            return back()->with('error', __('catalog.error.product_add_compare'));
        }
    }
}
