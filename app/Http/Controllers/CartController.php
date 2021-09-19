<?php

namespace App\Http\Controllers;

use App\Contracts\Service\Cart\AddCartServiceContract;
use App\Models\Product;
use App\Models\Seller;
use App\Service\Cart\RemoveCartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.main');
    }

    public function delete(RemoveCartService $cart, Product $product)
    {
        return response()->json(['status' => $cart->remove($product)]);
    }

    public function add(AddCartServiceContract $cart, Product $product, Seller $seller = null)
    {
        $cart->add($product, 1, $seller);
        return back();
    }

    public function setQuantity(Request $request, AddCartServiceContract $cart, Product $product){
        $request->validate([
            'quantity' => 'required|integer'
        ]);
        $cart->changeProductQuantity($product, $request->quantity);
        return back();
    }

}
