<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\OrderRepositoryContract;
use App\Contracts\Repository\UserRepositoryContract;
use App\Contracts\Service\OrderServiceContract;
use App\Contracts\Service\UsersAvatarServiceContract;
use App\Http\Requests\UpdateUserRequest;
use App\Service\Product\ViewedProductsService;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    const LIMIT_VIEWED_PRODUCTS_FOR_PREVIEW = 3;

    public function __construct(
        private UserRepositoryContract $userRepository,
        private ViewedProductsService $viewedProducts,
    )
    {}

    public function show($user): View
    {
        $user = $this->userRepository->find($user);
        $user->load('attachment');
        $lastOrder = $user->customer->orders->last();
        $viewedProductsDTOs = $this->viewedProducts->getViewedProductsDTOs(self::LIMIT_VIEWED_PRODUCTS_FOR_PREVIEW);
        $showElement = true;

        return view('users.show', compact('user', 'viewedProductsDTOs', 'lastOrder', 'showElement'));
    }

    public function edit($user): View
    {
        $user = $this->userRepository->find($user);

        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $user, UsersAvatarServiceContract $userAvatarService): RedirectResponse
    {
        $attributes = $request->validated();

        $user = $this->userRepository->update($user, array_filter($attributes));

        if ($attributes['avatar']) {
            $userAvatarService->addAvatar($user, $attributes['avatar']);
        }

        return redirect()->route('users.edit', $user)->with('success', true);
    }

    public function orders(User $user, OrderRepositoryContract $repository)
    {
        $orders = $repository->getAllOrders();
        $showElement = false;
        return view('users.history.orders')->with(compact('user', 'orders', 'showElement'));
    }

    public function showOrder(User $user, Order $order)
    {
        $orderService = app()->makeWith(
            OrderServiceContract::class,
            ['order' => $order]);
        $orderItemsDTOs = $orderService->getOrderItemsDTOs();

        return view('users.history.single-order')
            ->with(compact('user', 'order', 'orderItemsDTOs', 'orderService'));
    }
}
