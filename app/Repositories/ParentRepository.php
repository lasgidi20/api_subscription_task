<?php

namespace App\Repositories;

use App\Contract\MessageRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ParentRepository implements MessageRepositoryInterface {
    public function subscriptionMessage() 
    {
        $user = Auth::user();
        if ($user->role === 'parent') {
            return 'You have successfully subscribed as a Parent';
        }
    }
}
