<?php

namespace App\Http\Controllers;

use App\Contracts\Service\Discount\OtherDiscountServiceContract;
use App\Contracts\Service\Product\HotOfferServiceContract;
use App\Http\Requests\CatalogGetRequest;
use App\Contracts\Repository\ProductRepositoryContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class MainPageController extends Controller
{
    public function index(
        ProductRepositoryContract      $products,
        CatalogGetRequest              $request,
        OtherDiscountServiceContract $discountsService,
        HotOfferServiceContract         $hotOfferService,
    ): Factory|View|Application
    {
        $dayOfferProduct = $products->getDayOfferProduct();
        $topProductsDiscountsDTO = $discountsService
            ->getProductPriceDiscountDTOs(
                $products->getTopProducts()
            );
        $limitedEditionProductDiscountsDTO = $discountsService
            ->getProductPriceDiscountDTOs(
                $products->getLimitedEditionProduct($dayOfferProduct->id)
            );
        $dayOfferProductDiscountDTO = $discountsService->getProductPriceDiscountDTO($dayOfferProduct);
        $dayOfferTime = Carbon::tomorrow()->format('d.m.Y H:i');
        $hotOffers = $hotOfferService->get();

        return view('main')->with(compact(
                                        'topProductsDiscountsDTO',
                                                   'request',
                                                   'limitedEditionProductDiscountsDTO',
                                                   'dayOfferProductDiscountDTO',
                                                   'dayOfferTime',
                                                    'hotOffers',
                                                ));
    }
}
