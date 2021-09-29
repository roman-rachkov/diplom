<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Orchid\Attachment\File;

class UsersAvatarService
{
    public function addAvatar(User $user, UploadedFile $file): void
    {
        $user->avatar()->delete();
        $file = new File($file);
        $attachment = $file->load();
        $user->attachment()->sync($attachment);
    }

}
