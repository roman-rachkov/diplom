<?php

namespace App\Http\Controllers;

use App\Actions\CreateNewUserInOrder;
use App\Contracts\Repository\UserRepositoryContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class OrderController extends Controller
{
    public function index(GetCartServiceContract $contract)
    {
        if ($contract->getProductsQuantity() <= 0) {
            return redirect(route('cart.index'));
        }
        return view('cart.checkout');
    }

    public function checkUserEmail(Request $request, UserRepositoryContract $userRepository, string $email)
    {
        $status = (bool)$userRepository->getUserByEmail($email) && !auth()->check();
        if ($request->ajax()) {
            return response()->json(['status' => $status]);
        }
        return back();
    }

    public function registerUser(Request $request, StatefulGuard $guard, CreateNewUserInOrder $creator)
    {
        event(new Registered($user = $creator->create($request->all())));

        $guard->login($user);

        if($request->json()){
            return response()->json(['status' => (bool)$user]);
        }

        return back();
    }

    public function add(Request $request, GetCartServiceContract $cart)
    {
        $data = $request->all();
        $data['phone'] = str_replace(['+7','(',')','-',' '], '', $data['phone']);
        dd($data);
    }
}
