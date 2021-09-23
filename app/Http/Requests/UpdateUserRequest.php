<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'numeric|size:10|nullable|unique:users,phone,' . auth()->id() . ',id',
            'name' => 'required|min:4',
            'email' => 'required|unique:users,email,' . auth()->id() . ',id|email:filter',
            'password' => 'nullable|confirmed|min:6',
        ];
    }
}
