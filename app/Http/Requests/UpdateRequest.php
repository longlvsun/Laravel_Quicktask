<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'email' => 'email:rfc|max:255',
            'username' => 'string|regex:/\w*$/|max:255',
            'first_name' => 'max:20',
            'last_name' => 'max:20',
            'password' => 'max:20',
            'old_password' => 'required|max:20',
        ];
    }
}
