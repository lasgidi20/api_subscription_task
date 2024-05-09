<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\StrongPasswordRule;
use App\Http\Requests\RegisterRequest;
use App\Rules\ValidFormEntry;

use App\Http\Controllers\Api\BaseController as BaseController;

class RegisterController extends BaseController
{
    public function register(RegisterRequest $requests)
    {
        $input = $requests->validated();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['firstname'] =  $user->firstname;
        $success['lastname'] =  $user->lastname;
        $success['email'] =  $user->email;
        $success['role'] =  $user->role;
    
        return $this->sendResponse($success, 'User register successfully.');
    }
}
