<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\OrderRepositoryContract;
use App\Contracts\Repository\UserRepositoryContract;
use App\Contracts\Service\UsersAvatarServiceContract;
use App\Http\Requests\UpdateUserRequest;
use App\Service\Product\ViewedProductsService;
use App\Models\Order;
use App\Models\User;
use App\Service\UsersAvatarService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    private $userRepository;
    private $viewedProducts;

    const LIMIT_VIEWED_PRODUCTS_FOR_PREVIEW = 3;

    public function __construct(
        UserRepositoryContract $userRepository,
        ViewedProductsService $viewedProducts,
    )
    {
        $this->userRepository = $userRepository;
        $this->viewedProducts = $viewedProducts;
    }

    public function show($user): View
    {
        $user = $this->userRepository->find($user);
        $user->load('attachment');
        $lastOrder = $user->customer->orders->last();
        $arrayProductsWithDiscount = $this->viewedProducts->getViewedProductsWithDiscount(self::LIMIT_VIEWED_PRODUCTS_FOR_PREVIEW);

        return view('users.show', compact('user', 'arrayProductsWithDiscount', 'lastOrder'));
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
        return view('users.history.orders')->with(compact('user', 'orders'));
    }

    public function showOrder(User $user, Order $order)
    {
        return view('users.history.single-order')->with(compact('user', 'order'));
    }
}
