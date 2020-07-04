<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function __invoke (Request $request) {
       $data = $request->all();

    // REGISTER THE USER/CREATE A USER
    
    if(!$token = auth() -> attempt($request->only('email', 'password'))) {
        // validation
        return response(null, 401);
    }

        return response()->json(compact('token'));
    }
}
