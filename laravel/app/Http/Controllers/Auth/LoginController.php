<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    //validating and signing in
    public function __invoke (Request $request) {

        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if(!$token = auth() -> attempt($request->only('email', 'password'))) {
            return response(['errors' => 'Either the email or password is incorrect.'], 401);
        }

        return response()->json(['token' => compact('token'), 'errors' => true]);
    }
}
