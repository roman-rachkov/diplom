<?php

namespace App\Contracts\Service\User;

interface CreateUserServiceContract
{
    public function create(array $attributes);
}