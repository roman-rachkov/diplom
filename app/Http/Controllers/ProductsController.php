<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Repository\ReviewRepositoryContract;
use App\Contracts\Service\AddReviewServiceContract;
use App\Contracts\Service\AddToCartServiceContract;
use App\Contracts\Service\FlashMessageServiceContract;
use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Contracts\Service\Product\ViewedProductsServiceContract;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductsController extends Controller
{
    private ProductRepositoryContract $productRepository;
    private FlashMessageServiceContract $flashService;
    private AddReviewServiceContract $reviewService;

    public function __construct(
        ProductRepositoryContract $productRepository,
        FlashMessageServiceContract $flashService,
        AddReviewServiceContract $reviewService
    )
    {
        $this->productRepository = $productRepository;
        $this->flashService = $flashService;
        $this->reviewService = $reviewService;
    }

    /**
     * Display the specified resource.
     *
     * @param ProductDiscountServiceContract $discountService
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show(
        ProductDiscountServiceContract $discountService,
        string $slug
    ): Application|Factory|View
    {
        $product = $this->productRepository->find($slug);
        $discount = $discountService->getProductDiscounts($product);
        $avgPrice = round($product->prices->avg('value'), 2);
        $avgDiscountPrice = round($avgPrice * (1 - $discount),2);
        $discount = intval($discount * 100);
        $reviewsCount = $this->reviewService->getReviewsCount($product);
        $reviews = $this->reviewService->getPaginatedReviews($product);//$reviewService->getReviews($product);

        return view(
            'products.show',
            compact(
                'product',
                'avgDiscountPrice',
                'avgPrice',
                'discount',
            'reviewsCount',
            'reviews')
        );
    }

    public function addToCart
    (
        AddToCartServiceContract $addToCartService,
        ViewedProductsServiceContract $viewedService,
        string $slug, Seller
        $seller = null
    ): RedirectResponse
    {
        $product = $this->productRepository->find($slug);
        $viewedService->add($product);
        $qty = request('amount') ? : 1;

        if ($addToCartService->add($product, $qty, $seller)) {
            $this->flashService->flash(__('add_to_cart_service.on_success_msg'));
        } else {
            $this->flashService->flash(__('add_to_cart_service.on_error_msg'), 'danger');
        }
        return back();
    }

    public function addToComparison(
        CompareProductsServiceContract $compareService,
        string $slug
    ): RedirectResponse
    {
        $product = $this->productRepository->find($slug);

        if ($compareService->add($product)) {
            $this->flashService->flash(__('add_to_comparison_service.on_success_msg'));
        } else {
            $this->flashService->flash(__('add_to_comparison_service.on_error_msg'), 'danger');
        }
        return back();
    }

    public function addReviewsToView(Product $product, int $currentPage, int $perPage = 3): LengthAwarePaginator
    {
        return $this->reviewService->getPaginatedReviews($product, $perPage, $currentPage);
    }
}
