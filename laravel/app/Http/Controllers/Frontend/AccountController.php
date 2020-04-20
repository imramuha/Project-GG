<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AccountController extends Controller
{
    // siging
    public function __construct() {
        $this->middleware(['auth:api']);
    }

    /*
    * Get all users except the logged one in ^^
    */
    public function showUsers () {
        $users = User::where('id', '!=', auth()->id())->get();
        return response()->json($users);
    }

    public function showUser ($id) {
        
        // TODO:: !! WHILE REGISTEING FRIENDSHIP WE NEED TO ADD requesters ID ON user_id_one in relation_user ELSE on user_id_two
   
        $user = User::where('id', $id)->get();
        //$user = User::find($id)->relationTwo()->orderBy('name')->get();
        if(auth()->id() < $id) {
            $relation = User::find( auth()->id())->relationOne()->orderBy('name')->where('user_id_one', auth()->id())->where("user_id_two", $id)->get();
        } else {
            $relation = User::find( auth()->id())->relationTwo()->orderBy('name')->where('user_id_one', $id)->where("user_id_two", auth()->id())->get();  
        }
        return response()->json(['user' => $user, 'relation' => $relation]);
    }

    // determine the authenticated user's relation with the opened user :)
    public function showUserRelation($id) {
        // TODO: JOIN WITH THE PREVIOUS CALL

        if(auth()->id() < $id) {
            $relation = User::find( auth()->id())->relationOne()->orderBy('name')->where('user_id_one', auth()->id())->where("user_id_two", $id)->get();
        } else {
            $relation = User::find( auth()->id())->relationTwo()->orderBy('name')->where('user_id_one', $id)->where("user_id_two", auth()->id())->get();  
        }
        return response()->json([$relation]);
    }


}
