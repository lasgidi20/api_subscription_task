<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Rules\ValidFormEntry;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthenticateController extends BaseController
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
      
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) { 
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

