<?php

namespace App\Http\Controllers\Backoffice\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Index method for Admin Controller
    public function index()
    {
        return view('auth.mod.acces');
    }
}
