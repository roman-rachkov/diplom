<?php

namespace App\Contracts\Repository;

interface UserRepositoryContract
{
    public function getUserByEmail($email);
}
