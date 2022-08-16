<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email:rfc,dns|unique:users,email|max:255',
            'username' => 'required|string|regex:/\w*$/|max:255|unique:users,username',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'password' => 'required|max:20|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'username.required' => 'Vui lòng nhập username',
            'first_name.required' => 'Vui lòng nhập first name',
            'last_name.required' => 'Vui lòng nhập last name',
            'password.required' => 'Vui lòng nhập password',
        ];
    }
}
