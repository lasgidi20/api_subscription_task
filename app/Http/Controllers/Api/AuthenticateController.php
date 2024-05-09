<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Rules\ValidFormEntry;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthenticateController extends BaseController
{
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        
        if (Auth::attempt($validated)) { 
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['firstname'] =  $user->firstname;
            $success['lastname'] =  $user->lastname;
            $success['email'] =  $user->email;
            $success['role'] =  $user->role;
            
            return $this->sendResponse($success, 'User login successfully.');  
        } else { 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged Out'], 200);
    }
}
