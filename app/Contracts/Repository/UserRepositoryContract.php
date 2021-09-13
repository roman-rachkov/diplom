<?php

namespace App\Contracts\Repository;

use App\Models\User;

interface UserRepositoryContract
{
    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User;
}
