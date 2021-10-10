<?php

namespace App\Http\Controllers;

use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Models\Customer;
use Illuminate\Http\Request;

class CompareProductsController extends Controller
{
    public function index(
        Customer $customer,
        CompareProductsServiceContract $compareService
    )
    {
        $comparedProducts = $compareService->get($customer);
        return view('compare.show', compact('comparedProducts'));
    }
}
