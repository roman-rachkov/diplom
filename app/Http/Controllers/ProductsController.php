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
    private ReviewRepositoryContract $reviewRepository;

    public function __construct(
        ProductRepositoryContract $productRepository,
        FlashMessageServiceContract $flashService,
        ReviewRepositoryContract $reviewRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->flashService = $flashService;
        $this->reviewRepository = $reviewRepository;
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
        AddReviewServiceContract $reviewService,
        string $slug
    ): Application|Factory|View
    {
        $product = $this->productRepository->find($slug);
        $discount = $discountService->getProductDiscounts($product);
        $avgPrice = round($product->prices->avg('price'), 2);
        $avgDiscountPrice = round($avgPrice * (1 - $discount),2);
        $discount = intval($discount * 100);
        $reviewsCount = $reviewService->getReviewsCount($product);
        $reviews = $this->reviewRepository->getPaginatedReviews($product->id, 3, 1);

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
        $qty = request('amount');
        if (is_null($qty) || is_string($qty) || $qty < 0) $qty = 1;

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

    public function showReviews(Product $product): LengthAwarePaginator
    {
        $perPage = request('per_page')?: 3;
        $currentPage = request('current_page')?: 1;
        return $this->reviewRepository->getPaginatedReviews($product->id, $perPage, $currentPage);
    }
}
