<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function __invoke (Request $request) {

        $this->validate(request(), [
            'username' => 'required|max:15|min:5|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = User::create(request(['username', 'email', 'password']));

        if($user) {
        // if auth was succesful after registration, send a token
            if(!$token = auth() -> attempt($request->only('email', 'password'))) {
                return response(null, 401);
            }
            return response()->json(['token' => compact('token'), 'errors' => true]);
        }    
        return response(['errors' => 'Please try again later or try contacting us.'], 401);
    }
}
