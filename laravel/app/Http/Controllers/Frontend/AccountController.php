<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Post;
use App\Models\Status;

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

        $user = User::where('id', $id)->get();
        $relation_one = User::find( auth()->id())->relationOne()->orderBy('name')->where('user_id_one', auth()->id())->where("user_id_two", $id)->get();
        $relation_two = User::find( auth()->id())->relationTwo()->orderBy('name')->where('user_id_one', $id)->where("user_id_two", auth()->id())->get();  

        $relation = array_merge($relation_one->toArray(), $relation_two->toArray());
        return response()->json(["user" => $user, "relation" => $relation]);
    }

    // show all friends
    public function showFriends() {
        // show friends -> works!! CLEAN IT UP

        $relations_one = User::find(auth()->id())->relationOne()->where('name', 'friends')->get();
        $relations_two = User::find(auth()->id())->relationTwo()->where('name', 'friends')->get();

        $user_ids_array = array();

        foreach($relations_one as $user) {
            array_push($user_ids_array, $user->pivot->user_id_two);
        }

        foreach($relations_two as $user) {
            array_push($user_ids_array, $user->pivot->user_id_one);
        }

        $users = User::with("status")->find($user_ids_array);

        $relations = array_merge($relations_one->toArray(), $relations_two->toArray());
        
        // return all the friends
        return response()->json($users);
    }



     /*
    * Get all users except the logged one in ^^
    */
    public function showPosts () {

        $posts = Post::get();
        return response()->json($posts);
    }

         /*
    * Get all users except the logged one in ^^
    */
    public function showUserPosts () {
     
        $posts = Post::where('creator_id', '=', auth()->id())->get();
        return response()->json($posts);
    }


}
