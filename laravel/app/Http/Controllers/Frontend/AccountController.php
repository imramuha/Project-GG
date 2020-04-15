<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AccountController extends Controller
{
    /*
    * PROFILE 
    */
    public function showRole () {
        $roles = User::find(2)->roles()->orderBy('name')->get();
        return response()->json($roles);
    }
}
