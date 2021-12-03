<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\SellerRepositoryContract;
use App\Contracts\Service\Discount\OtherDiscountServiceContract;
use App\Contracts\Service\SellerServiceContract;
use Illuminate\View\View;

class SellerController extends Controller
{
    public function __construct(
        private SellerRepositoryContract $sellerRepository,
        private SellerServiceContract $sellerService,
        private OtherDiscountServiceContract $discountService,
    )
    {}

    public function show($id): View
    {
        $seller = $this->sellerRepository->find($id);

        $popularProducts = $this->sellerService->getPopularProducts($seller);

        $popularProductsDiscountsDTOs = $this->discountService->getProductPriceDiscountDTOs($popularProducts, $seller);

        return view('seller.show', compact('seller', 'popularProductsDiscountsDTOs'));
    }
}
