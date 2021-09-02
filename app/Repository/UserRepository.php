<?php

namespace App\Repository;

use App\Contracts\Repository\UserRepositoryContract;
use App\Models\User;

class UserRepository implements UserRepositoryContract
{
    /**
     * @param $email
     * @return User
     */
    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
