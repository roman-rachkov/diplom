<?php

namespace App\Contracts\Service;

use App\Models\User;
use Illuminate\Http\UploadedFile;

interface UsersAvatarServiceContract
{
    public  function addAvatar(User $user, UploadedFile $file): void;
}
