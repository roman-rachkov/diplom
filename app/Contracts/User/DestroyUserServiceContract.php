<?php

namespace App\Contracts\User;

interface DestroyUserServiceContract
{
    public function destroy(string $id);
}