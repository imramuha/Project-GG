<?php

namespace App\Http\Controllers\Backoffice\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class NoAccessController extends Controller
{
    public function __construct()
    {
       
    }

    //Index method for Admin Controller
    public function index()
    {
        auth('web')->logout();
        return view('auth.no-access.access');
    }

    //No acces for moderator
    public function indexModerator()
    {
        return view('auth.moderator.access');
    }
}
