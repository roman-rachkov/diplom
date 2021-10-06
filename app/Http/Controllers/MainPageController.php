<?php

namespace App\Http\Controllers;


use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Http\Requests\CatalogGetRequest;
use App\Contracts\Repository\ProductRepositoryContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index(
        ProductRepositoryContract      $products,
        CatalogGetRequest              $request,
        ProductDiscountServiceContract $discountsService
    ): Factory|View|Application
    {
        $topProducts = $products->getTopProducts();
        $discounts = $discountsService->getCatalogDiscounts($topProducts);
        return view('main')->with(compact('topProducts', 'discounts', 'request'));
    }
}
