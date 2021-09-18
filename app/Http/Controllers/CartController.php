<?php

namespace App\Http\Controllers;

use App\Contracts\Service\CartServiceContract;
use App\Models\Product;
use App\Models\Seller;

class CartController extends Controller
{
    public function index(){
        return view('cart.main');
    }

    public function delete(CartServiceContract $cart,Product $product){
        return response()->json(['status' => $cart->remove($product)]);
    }

    public function add(CartServiceContract $cart, Product $product, Seller $seller = null){
//        $cart->
    }
}
