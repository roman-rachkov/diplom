<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\UserRepositoryContract;
use App\Contracts\Service\UsersAvatarServiceContract;
use App\Http\Requests\UpdateUserRequest;
use App\Service\UsersAvatarService;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
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

    public function update(UpdateUserRequest $request, $user, UsersAvatarServiceContract $userAvatarService): RedirectResponse
    {
        $attributes = $request->validated();

        $user = $this->userRepository->update($user, array_filter($attributes));

        if ($attributes['avatar']) {
            $userAvatarService->addAvatar($user, $attributes['avatar']);
        }

        return redirect()->route('users.edit', $user)->with('success', true);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = str_replace(['+7', '(', ')', '-', ' '], '', $value);
    }
}
