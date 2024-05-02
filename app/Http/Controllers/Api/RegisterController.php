<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\StrongPasswordRule;
use App\Rules\ValidFormEntry;
use App\Http\Requests\RegisterRequest;
use Validator;
use App\Http\Controllers\Api\BaseController as BaseController;

class RegisterController extends BaseController
{
    public function register(RegisterRequest $requests)
    {
        $user = new User;
        $user->firstname = $requests->input('firstname');
        $user->lastname = $requests->input('lastname');
        $user->email = $requests->input('email');
        $user->role =  $requests->input('role');
        $user->password = bcrypt($requests->input('password'));
        $confirm_password = $user->password;
        $user->save();
        
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['firstname'] =  $user->firstname;
        $success['lastname'] =  $user->lastname;
        $success['email'] =  $user->email;
        $success['role'] =  $user->role;
    
        return $this->sendResponse($success, 'User register successfully.');
    }
}
