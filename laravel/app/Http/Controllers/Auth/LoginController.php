<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    //    // siging
    public function __invoke (Request $request) {
        if(!$token = auth() -> attempt($request->only('email', 'password'))) {
            return response(['errors' => 'Either the email or password is incorrect.'], 401);
        }

        return response()->json(['token' => compact('token'), 'errors' => true]);
    }
}
