<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Service\Cart\AddCartServiceContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\Cart\RemoveCartServiceContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\FlashMessageServiceContract;
use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompareProductsController extends Controller
{
    private CompareProductsServiceContract $compareService;

    public function __construct(CompareProductsServiceContract $compareService)
    {
        $this->compareService = $compareService;
    }


    public function index(
        CustomerServiceContract $customerService,
        GetCartServiceContract $getCart,
        AddCartServiceContract $addCart,
        RemoveCartServiceContract $removeCart
    )
    {
        $comparedProducts = $this->compareService->get($customerService->getCustomer());
        return view('compare.show', compact('comparedProducts'));
    }

    public function removeProduct(
        $productSlug,
        CustomerServiceContract $customerService,
        ProductRepositoryContract $productRepository,
        FlashMessageServiceContract $flashService
    )
    {
        $product = $productRepository->find($productSlug);
        if ($this->compareService->remove($product, $customerService->getCustomer())) {
            $flashService->flash(__('add_to_comparison_service.on_remove_success_msg.on_success_msg'));
        } else {
            $flashService->flash(__('add_to_comparison_service.on_error_msg'), 'danger');
        }
        return back();
    }
}
