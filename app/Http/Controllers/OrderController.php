<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\OrderRepositoryContract;
use App\Contracts\Repository\PaymentsServicesRepositoryContract;
use App\Contracts\Repository\UserRepositoryContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\DeliveryCostServiceContract;
use App\Contracts\Service\FlashMessageServiceContract;
use App\Contracts\Service\PaymentsIntegratorServiceContract;
use App\DTO\OrderDTO;
use App\Http\Requests\OrderConfirmRequest;
use App\Models\Order;
use Closure;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(function (Request $request, Closure $next) {
            if (app(GetCartServiceContract::class)->getProductsQuantity() <= 0) {
                return redirect()->route('cart.index');
            }
            return $next($request);
        }, ['except' => ['repay', 'repayForm']]);
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

    public function registerUser(Request $request, StatefulGuard $guard, CreatesNewUsers $creator)
    {
        event(new Registered($user = $creator->create($request->all())));

        $guard->login($user);

        if ($request->json()) {
            return response()->json(['status' => (bool)$user]);
        }

        return back();
    }

    public function confirm(
        OrderConfirmRequest                $request,
        PaymentsServicesRepositoryContract $repository,
        GetCartServiceContract             $cart,
        DeliveryCostServiceContract        $delivery,
    )
    {
        try {
            $data = $request->validated();
            $data['payService'] = $repository->getPaymentsServiceById($data['payment'])->name;
            $data['totalCost'] = $cart->getTotalCost() + $delivery->getCost($data['delivery']);
            session(['order_data' => $data]);

        } catch (\Throwable $e) {
            abort($e->getCode(), $e->getMessage());
        }
        return view('cart.step-four')->with(compact('data'));
    }

    public function add(Request $request, PaymentsIntegratorServiceContract $payments, OrderRepositoryContract $orderRepository)
    {
        try {
            if (!session('order_data')) {
                return redirect()->route('order.index');
            }
            $data = collect(session('order_data'));
            $paymentsService = $payments->getPaymentsServiceById($data['payment']);
            unset($data['payment']);
            unset($data['payService']);
            $order = $orderRepository->add(OrderDTO::create($data));
            session(['order' => $order]);
            session(['payService' => $paymentsService]);

        } catch (\Throwable $e) {
            abort($e->getCode(), $e->getMessage());
        }
        return $paymentsService->render(compact('order'));
    }

    public function repayForm(FlashMessageServiceContract $serviceContract, Order $order)
    {
        if ($order->payment?->payed_at !== null) {
            $serviceContract->flash('Payment Successful complete');
            return back();
        }
        return view('users.history.repay')->with(compact('order'));
    }

    public function repay(Request $request, FlashMessageServiceContract $serviceContract, PaymentsIntegratorServiceContract $contract, Order $order)
    {
        if ($order->payment?->payed_at !== null) {
            $serviceContract->flash('Payment Successful complete');
            return back();
        }
        $service = $contract->getPaymentsServiceById($request->payment);
        session(['order' => $order]);
        session(['payService' => $service]);
        session(['payment' => $order->payment]);
        return $service->render(compact('order'));
    }

}
