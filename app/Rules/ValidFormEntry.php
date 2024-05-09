<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidFormEntry implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $result = preg_match('/[^a-zA-Z0-9]/', $value) > 0 ;

       if ($result) {
           $fail('cant contain special characters only real characters');
       }
      
    }
}

