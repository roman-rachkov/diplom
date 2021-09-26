<?php

namespace App\Http\Controllers;

use App\Contracts\Service\Cart\GetCartServiceContract;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(GetCartServiceContract $contract)
    {
        if ($contract->getProductsQuantity() <= 0) {
            return redirect(route('cart.index'));
        }
        return view('cart.checkout');
    }

    public function add(Request $request, GetCartServiceContract $cart)
    {
        dd($request->all());
    }
}
