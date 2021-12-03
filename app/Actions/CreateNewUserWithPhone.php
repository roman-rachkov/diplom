<?php

namespace App\Actions;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Orchid\Screen\Repository;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Nullable;

class CreateNewUserWithPhone implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'phone' => 'sometimes|required|digits:10',
            'password' => $this->passwordRules(),
        ])->validate();

        $arr = [
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'permissions' => ["account" => "1"],
        ];

        if (isset($input['phone'])) $arr['phone'] = $input['phone'] ;

        return User::create($arr);
    }
}
