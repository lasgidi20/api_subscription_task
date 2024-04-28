<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'required',
          'role' => 'required',
          'password' => 'required',
          'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
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
