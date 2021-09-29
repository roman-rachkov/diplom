<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\UserRepositoryContract;
use App\Http\Requests\UpdateUserRequest;
use App\Service\UsersAvatarService;

class UserController extends Controller
{
    private $userRepository;
    private $userAvatarService;

    public function __construct(UserRepositoryContract $userRepository, UsersAvatarService $userAvatarService)
    {
        $this->userRepository = $userRepository;
        $this->userAvatarService = $userAvatarService;
    }

    public function show($user)
    {
        $user = $this->userRepository->find($user);
        $user->load('attachment');

        return view('users.show', compact('user'));
    }

    public function edit($user)
    {
        $user = $this->userRepository->find($user);

        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $user)
    {
        $attributes = $request->validated();

        $user = $this->userRepository->update($user, array_filter($attributes));

        if ($attributes['avatar']) {
            $this->userAvatarService->addAvatar($user, $attributes['avatar']);
        }

        return redirect()->route('users.edit', $user)->with('success', true);
    }
}
