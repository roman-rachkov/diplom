<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Service\AddToCartServiceContract;
use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Contracts\Service\Product\ViewedProductsServiceContract;
use App\Models\Seller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    private ProductRepositoryContract $productRepository;

    public function __construct(ProductRepositoryContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param ProductDiscountServiceContract $discountService
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show(ProductDiscountServiceContract $discountService, string $slug): Application|Factory|View
    {
        $product = $this->productRepository->find($slug);
        $discount = $discountService->getProductDiscounts($product);
        $avgPrice = $product->prices->avg('value');
        $avgDiscountPrice = $avgPrice * (1 - $discount);
        $discount = intval($discount * 100);

        return view('products.show', compact('product', 'avgDiscountPrice', 'avgPrice', 'discount'));
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
            flash('Товар успешно добавлен в корзину!');
        } else {
            flash('Не получилось добавить товар, попробуйте позднее', 'danger');
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
            flash('Товар успешно добавлен!');
        } else {
            flash('Не получилось добавить товар, попробуйте позднее', 'danger');
        }
        return back();
    }
}
