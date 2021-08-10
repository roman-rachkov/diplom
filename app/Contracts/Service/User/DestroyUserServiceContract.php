<?php

namespace App\Contracts\Service\User;

interface DestroyUserServiceContract
{
    public function destroy(string $id);
}