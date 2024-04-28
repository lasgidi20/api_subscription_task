<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;

class AuthenticateController extends BaseController
{
    public function login(Request $request)
    {
      if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
          $user = Auth::user(); 
          $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
          $success['firstname'] =  $user->firstname;
          $success['lastname'] =  $user->lastname;
          $success['email'] =  $user->email;
          $success['role'] =  $user->role;
 
          return $this->sendResponse($success, 'User login successfully.');
      } 
      else { 
          return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
      } 
    }

    public function logout()
    {
      Auth::logout();
      return response()->json(['message' => 'Logged Out'], 200);
    }
}

