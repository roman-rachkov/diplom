<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\ProductRepositoryContract;
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
        Customer $customer
    )
    {
        $comparedProducts = $this->compareService->get($customer);
        //dd($comparedProducts->get('products'));
        return view('compare.show', compact('comparedProducts'));
    }

    public function removeProduct(
        $productSlug,
        Customer $customer,
        ProductRepositoryContract $productRepository,
        FlashMessageServiceContract $flashService
    ): RedirectResponse
    {
        $product = $productRepository->find($productSlug);

        if ($this->compareService->remove($product, $customer)) {
            $flashService->flash(__('add_to_comparison_service.on_remove_success_msg.on_success_msg'));
        } else {
            $flashService->flash(__('add_to_comparison_service.on_error_msg'), 'danger');
        }
        return back();
    }
}
