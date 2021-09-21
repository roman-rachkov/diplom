<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogPageController extends Controller
{
    public function index(ProductRepositoryContract $repo, Request $request)
    {
        $curPage = $request->get('page') ?? 1;
        $products = $repo->getAllProducts($curPage);
        return view('catalog', compact('products'));
    }

    public function getProductForCatalogByCategorySlug(ProductRepositoryContract $repo, Request $request, $slug)
    {
        $curPage = $request->get('page') ?? 1;
        $products = $repo->getProductsForCategory($slug, $curPage);
        return view('catalog', compact('products'));
    }
}
