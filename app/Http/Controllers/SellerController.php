<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\SellerRepositoryContract;
use App\Contracts\Service\SellerServiceContract;
use App\Service\Product\ProductDiscountService;
use Illuminate\View\View;

class SellerController extends Controller
{
    private SellerServiceContract $sellerService;
    private SellerRepositoryContract $sellerRepository;
    private ProductDiscountService $discountRepo;

    public function __construct(
        SellerRepositoryContract $sellerRepository,
        SellerServiceContract $sellerService,
        ProductDiscountService $discountRepo,
    )
    {
        $this->sellerRepository = $sellerRepository;
        $this->sellerService = $sellerService;
        $this->discountRepo = $discountRepo;
    }

    public function show($id): View
    {
        $seller = $this->sellerRepository->find($id);

        $popularProducts = $this->sellerService->getPopularProductsFrom($seller);

        $discounts = $this->discountRepo->getCatalogDiscounts($popularProducts);

        return view('seller.show', compact('seller', 'popularProducts', 'discounts'));
    }
}
