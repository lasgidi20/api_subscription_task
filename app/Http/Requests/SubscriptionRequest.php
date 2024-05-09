<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use  App\Rules\ValidFormEntry;

class SubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
          'confirm' => 'required',
          'role' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'confirm' => 'The confirmation checkbox is required.',
            'role' => 'The field is required.',
        ];
    }
}


