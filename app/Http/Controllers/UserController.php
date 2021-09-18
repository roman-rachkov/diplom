<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\UserRepositoryContract;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show($user)
    {
//        $user = auth()->user();

        $user = $this->userRepository->find($user);

        return view('users.show', compact('user'));
    }

    public function edit($user)
    {
        $user = $this->userRepository->find($user);

        dd($user);
        return view('users.edit', compact('user'));
    }
}
