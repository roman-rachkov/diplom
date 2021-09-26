<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\PhoneNumber;

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
            'phone' => 'digits:10|nullable|unique:users,phone,' . auth()->id() . ',id',
            'name' => 'required|min:4',
            'email' => 'required|unique:users,email,' . auth()->id() . ',id|email:filter',
            'password' => 'nullable|confirmed|min:6',
            'avatar' => 'file|image|nullable|max:2048'
        ];
    }

    public function prepareForValidation()
    {
        $phone = $this->input('phone');
        $phone = str_replace(['+','(',')','-','_'], '', $phone);
        $phone = substr($phone, 1);

        if (!$this->input('avatar'))
        $this->merge([
            'avatar' => null,
            'phone' => $phone,
        ]);
    }
}
