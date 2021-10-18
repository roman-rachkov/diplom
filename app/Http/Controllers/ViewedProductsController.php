<?php

namespace App\Http\Controllers;

use App\Service\AdminSettingsService;
use App\Service\Product\ViewedProductsService;
use Illuminate\View\View;

class ViewedProductsController extends Controller
{
    private ViewedProductsService $viewedProducts;
    private AdminSettingsService $adminSettings;

    public function __construct(
        ViewedProductsService $viewedProducts,
        AdminSettingsService $adminSettings,
    )
    {
        $this->viewedProducts = $viewedProducts;
        $this->adminSettings = $adminSettings;
    }

    public function viewedProducts($user): View
    {
        $limit = $this->adminSettings->get('userViewProductCount', 20);
        $arrayProductsWithDiscount = $this->viewedProducts->getViewedProductsWithDiscount($limit);

        return view('products.history_viewed', compact('arrayProductsWithDiscount', 'user'));
    }

}
