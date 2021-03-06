<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class MeController extends Controller
{
    // siging
    public function __construct() {
        $this->middleware(['auth:api']);
    }

    public function __invoke(Request $request) {

        $user = $request->user();

        return response()->json([
            'email' => $user->email,
            'name' => $user->name,
        ]);
    }
}
