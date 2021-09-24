<?php

namespace App\Repository;

use App\Contracts\Repository\UserRepositoryContract;
use App\Models\User;
use Illuminate\Container\Container as Application;


class UserRepository implements UserRepositoryContract
{
    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function update(int $user, array $attribute): User
    {
        $user = $this->find($user);
        $user->update($attribute);
        return  $user;
    }
}
