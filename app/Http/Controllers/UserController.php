<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\UserRepositoryContract;
use App\Contracts\Service\UsersAvatarServiceContract;
use App\Http\Requests\UpdateUserRequest;
use App\Service\Product\ProductDiscountService;
use App\Service\Product\ViewedProductsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    private $userRepository;
    private $viewedProducts;
    private $discountRepo;

    public function __construct(
        UserRepositoryContract $userRepository,
        ViewedProductsService $viewedProducts,
        ProductDiscountService $discountRepo
    )
    {
        $this->userRepository = $userRepository;
        $this->viewedProducts = $viewedProducts;
        $this->discountRepo = $discountRepo;
    }

    public function show($user): View
    {
        $user = $this->userRepository->find($user);
        $user->load('attachment');
        $arrayProductsWithDiscount = $this->getProductsWithDiscount(3);

        return view('users.show', compact('user', 'arrayProductsWithDiscount'));
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

    public function viewedProducts($user): View
    {
        $arrayProductsWithDiscount = $this->getProductsWithDiscount(20);

        return view('products.history_viewed', compact('arrayProductsWithDiscount', 'user'));
    }

    public function getProductsWithDiscount(int $limit): array
    {
        $result['products'] = $this->viewedProducts->getViewed()->take($limit);
        $result['discounts'] = $this->discountRepo->getCatalogDiscounts($result['products']);

        return $result;
    }
}
