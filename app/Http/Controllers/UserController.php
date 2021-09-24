<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\UserRepositoryContract;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show($user)
    {
        $user = $this->userRepository->find($user);
        $user->load('attachment');

        return view('users.show', compact('user'));
    }

    public function edit($user)
    {
        $user = $this->userRepository->find($user);

        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $user)
    {
        $attributes = $request->validated();
        dump(array_filter($attributes));
        dump($user);
        $user = $this->userRepository->update($user, array_filter($attributes));

        // Выдает ошибку при прекриплении файла изображения:
        // Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`laravel`.`attachmentable`,
        // CONSTRAINT `attachmentable_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`)
        // ON DELETE CASCADE ON UPDATE CASCADE) (SQL: insert into `attachmentable` (`attachment_id`, `attachmentable_id`, `attachmentable_type`)
        // values (0, 62, App\Models\User))

        $avatar = $attributes['avatar'] ?? null;
        if ($avatar) {
            $user->attachment()->syncWithoutDetaching($avatar);
        }
        return redirect()->route('users.edit', $user);
    }
}
