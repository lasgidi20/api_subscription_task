<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use  App\Rules\ValidFormEntry;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => 'required|min:2|max:100',
            'lastname' => 'required|min:2|max:100',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required|min:10|max:50',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'The firstname field is required.',
            'firstname.string' => 'The firstname field must be a string.',
            'firstname.max' => 'The name field must not exceed 100 characters.',
            'email.required' => 'The email field is required.',
            'email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address is already in use.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password field must be a string.',
        ];
    }
}
