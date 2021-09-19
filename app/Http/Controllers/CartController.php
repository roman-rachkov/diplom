<?php

namespace App\Http\Controllers;

use App\Contracts\Service\Cart\AddCartServiceContract;
use App\Models\OrderItem;
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

    public function delete(Request $request, RemoveCartService $cart, Product $product)
    {
        $status = $cart->remove($product);
        if ($request->ajax()) {
            return response()->json(['status' => $status]);
        }
        return back();
    }

    public function add(AddCartServiceContract $cart, Product $product, Seller $seller = null)
    {
        $cart->add($product, 1, $seller);
        return back();
    }

    public function setQuantity(Request $request, AddCartServiceContract $cart, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer'
        ]);
        $cart->changeProductQuantity($product, $request->quantity);
        return back();
    }

    public function setSeller(Request $request, AddCartServiceContract $cart, Product $product)
    {
        dd($request->all());
    }

    public function update(Request $request, AddCartServiceContract $cart, Product $product)
    {
        $status = $cart->update($product, $request->except('_token'));
        if ($request->ajax()) {
            return response()->json(['status' => $status]);
        }
        return back();
    }

}
