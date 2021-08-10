<?php

namespace App\Contracts\Service\User;

interface UpdateUserServiceContract
{
    public function update(array $attributes,string $id);
}