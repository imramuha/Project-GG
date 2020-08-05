<?php

namespace App\Http\Controllers\Backoffice\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    protected function guard()
    {
        // specify the guard that should be used for login attempts
        return Auth::guard('web');
    }
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    


    protected function authenticated($request, $user) {

        $loggedUser = User::with('role')->find(auth('web')->user()->id);
        ;

        if($loggedUser->role->name === 'Admin') {
            return redirect('/admin');
        } elseif ($loggedUser->role->name === 'Mod') {
            return redirect('/mod');
        } else {
            return redirect('/no-access');
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }
}
