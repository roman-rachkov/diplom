<?php

namespace App\Contracts\User;

interface UpdateUserServiceContract
{
    public function update(array $attributes,string $id);
}