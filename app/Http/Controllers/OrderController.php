<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\UserRepositoryContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Providers\FortifyServiceProvider;
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

    public function login(Request $request)
    {
        dd($request);
    }

    public function checkUserEmail(Request $request, User $email)
    {
        dd($email);
        return (bool)$userRepository->getUserByEmail($request->email);
    }

    public function add(Request $request, GetCartServiceContract $cart)
    {
        dd($request->all());
    }
}
