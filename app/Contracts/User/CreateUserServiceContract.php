<?php

namespace App\Contracts\User;

interface CreateUserServiceContract
{
    public function create(array $attributes);
}