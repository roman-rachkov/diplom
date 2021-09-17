<?php

namespace App\Http\Controllers;

use App\Contracts\Service\CartServiceContract;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        return view('cart.main');
    }

    public function delete(OrderItem $item){
        $status = app(CartServiceContract::class)->remove($item->price);
        return response()->json(['status' => $status]);
    }
}
