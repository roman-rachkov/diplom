<?php

namespace App\Http\Requests;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderConfirmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => ['required', new PhoneRule()],
            'email' => 'required|email:rfc',
            'delivery' => 'required',
            'city' => 'required',
            'address' => 'required',
            'payment' => 'required|exists:payments_services,id'
        ];
    }
}
