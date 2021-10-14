<?php

namespace App\Http\Controllers;

use App\Service\AdminSettingsService;
use App\Service\Product\ProductDiscountService;
use App\Service\Product\ViewedProductsService;
use Illuminate\View\View;

class ViewedProductsController extends Controller
{
    private ViewedProductsService $viewedProducts;
    private ProductDiscountService $discountRepo;
    private AdminSettingsService $adminSettings;

    public function __construct(
        ViewedProductsService $viewedProducts,
        ProductDiscountService $discountRepo,
        AdminSettingsService $adminSettings,
    )
    {
        $this->viewedProducts = $viewedProducts;
        $this->discountRepo = $discountRepo;
        $this->adminSettings = $adminSettings;
    }

    public function viewedProducts($user): View
    {
        $limit = $this->adminSettings->get('userViewProductCount', 20);
        $arrayProductsWithDiscount = $this->getViewedProductsWithDiscount($limit);

        return view('products.history_viewed', compact('arrayProductsWithDiscount', 'user'));
    }

    private function getViewedProductsWithDiscount(int $limit): array
    {
        $viewedProducts = $this->viewedProducts->getViewed()->take($limit);
        $result['products'] = $viewedProducts->map( fn($viewed) => $viewed->product );
        $result['discounts'] = $this->discountRepo->getCatalogDiscounts($result['products']);

        return $result;
    }
}
