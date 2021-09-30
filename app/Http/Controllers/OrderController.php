<?php

namespace App\Http\Controllers;

use App\Actions\CreateNewUserInOrder;
use App\Contracts\Repository\AdminSettingsRepositoryContract;
use App\Contracts\Repository\OrderRepositoryContract;
use App\Contracts\Repository\PaymentsServiceRepositoryContract;
use App\Contracts\Repository\UserRepositoryContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\DeliveryCostServiceContract;
use App\Contracts\Service\PaymentsIntegratorServiceContract;
use App\DTO\OrderDTO;
use Closure;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(function (Request $request, Closure $next) {
            if (app(GetCartServiceContract::class)->getProductsQuantity() <= 0) {
                return redirect()->route('cart.index');
            }
            return $next($request);
        });
    }

    public function index()
    {
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

        if ($request->json()) {
            return response()->json(['status' => (bool)$user]);
        }

        return back();
    }

    public function confirm(
        Request                           $request,
        PaymentsServiceRepositoryContract $repository,
        GetCartServiceContract            $cart,
        DeliveryCostServiceContract       $delivery
    )
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required|regex:/^\+7\(\d{3}\) \d{3}-\d{2}-\d{2}$/i',
            'email' => 'required|email:rfc',
            'delivery' => 'required',
            'city' => 'required',
            'address' => 'required',
            'payment' => 'required|exists:payments_services,id'
        ]);
        $data['payService'] = $repository->getPaymentsServiceById($data['payment'])->name;
        $data['totalCost'] = $cart->getTotalCost() + $delivery->getCost($data['delivery']);
        session(['order_data' => $data]);

        return view('cart.step-four')->with(compact('data'));
    }

    public function add(Request $request, PaymentsIntegratorServiceContract $payments, OrderRepositoryContract $orderRepository)
    {
        if (!session('order_data')) {
            return redirect()->route('order.index');
        }
        $data = collect(session('order_data'));
        $paymentsService = $payments->getPaymentsServiceById($data['payment']);
        $data['phone'] = str_replace(['+7', '(', ')', '-', ' '], '', $data['phone']);
        unset($data['payment']);
        unset($data['payService']);
        $order = $orderRepository->add(OrderDTO::create($data));

        return $paymentsService->render()->with(compact('order'));

    }
}
