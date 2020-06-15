<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Post;
use App\Models\LikedPost;
use App\Models\Status;
use App\Models\Comment;
use App\Models\Review;
use App\Models\UserGameData;
use App\Models\Game;
use App\Models\Message;

use App\Models\Relation;

use App\Models\Lobby;

use App\Events\NewMessage;
use App\Events\MyEvent;
use Auth;
use Pusher;

class AccountController extends Controller
{
    // siging
    var $pusher;
    public function __construct() {
        $this->middleware(['auth:api']);

        $app_id = '1007194';
        $app_key = 'c8af74134473385784fa';
        $app_secret = '0c0667626ba79b7d337e';
        $app_cluster = 'eu';
    
        $this->pusher = new Pusher\Pusher( $app_key, $app_secret, $app_id, array('cluster' => $app_cluster) );
    
    }

    /*
    * show logged in user ^^
    */
    public function showMe () {

        $user = User::where('id', '=', auth()->id())->with('status')->get();
        $reviews = Review::where('user_id', '=', auth()->id())->with('reviewer')->get();
        return response()->json(['user' => $user, 'reviews' => $reviews]);
    }

    public function editUser (Request $request) {

        $id = auth()->user()->id;

        User::where('id', '=', $id)->update(array(
            'email' => $request->input('email'),
            'image' => $request->input('image'),
        ));

        $response = array('response' => 'Your profile has been updated.', 'succes' => true);
        return $response;
    }

        /*
    * Get all users except the logged one in ^^
    */
    public function showUsers () {
        $users = User::where('id', '!=', auth()->id())->get();
        return response()->json($users);
    }


    public function showUser ($id) {
        
        $user = User::where('id', $id)->get();

        return response()->json(['user' => $user]);
    }


    
    /* 
    * search for users
    */
    public function searchUsers (Request $request) {
        $searchTerm = $request->input('searchTerm');

        $users = User::where('username','LIKE','%'.$searchTerm.'%')->get();

        return response()->json(['users' => $users]);
    }


    public function userStatus (Request $request) {

        $status_name = $request->input('status');
        $status = Status::where('name', "=", $status_name)->first();

        
        User::where('id', '=', auth()->id())->update(array(
            'status_id' => $status->id,
        ));

        return array(['response' => 'The status has been updated.']);
        // this function changes the user status
        // whenever they log in
        // log out
        // stay afk
        // <ingame class=""></ingame>
        // change their own status to offline/online
        // to do: when user logs in onlin
        // when logs out -> offline
        // user can set status themselves too
        /*      User::where('id', '=', $id)->update(array(
            'email' => $request->input('email'),
            'image' => $request->input('image'),
        ));
*/
    }

    // determine the authenticated user's relation with the opened user :)
    public function showRelation($id) {

        // TODO:: !! WHILE REGISTEING FRIENDSHIP WE NEED TO ADD requesters ID ON user_id_one in relation_user ELSE on user_id_two
        // TODO: JOIN WITH THE PREVIOUS CALL

        $user = User::find($id)->get();
        $relation_one = User::find( auth()->id())->relationOne()->orderBy('name')->where('user_id_one', auth()->id())->where("user_id_two", $id)->get();
        $relation_two = User::find( auth()->id())->relationTwo()->orderBy('name')->where('user_id_one', $id)->where("user_id_two", auth()->id())->get();  

        $relation = array_merge($relation_one->toArray(), $relation_two->toArray());

        return response()->json($relation);
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
    *  createRelation
    */
    public function createRelation (Request $request) {
        
        $relation = Relation::where('name', $request->input('relation'))->first();  
        $relation_id = $relation->id;

        $profile = User::find($request->input('profile_id'));
        $profile_id = $request->input('profile_id');

        $user_id = auth()->user()->id;      
        $user = User::find(auth()->id());

        // depending on what kind of relation is found => do the following. ^ clean it up by higher/lower users id <>
        if($user->relationOne()->wherePivot('user_id_one',  auth()->id())->wherePivot("user_id_two", $profile_id)->detach()) {
            
            // THIS detaches the logged in user/profile id's relation!!!!
            // next step is recreating that relationship -> attach
            // Also works -> this makes the new relation
            $user->relationOne()->attach($relation_id, ['user_id_two'=>$profile->id, "user_id_one"=>$logged_id]);
            
            return array(["response"=>"relation One was succesfully updated."]);
        
        } else if ( $user->relationTwo()->wherePivot('user_id_one', $profile_id)->wherePivot("user_id_two", auth()->id())->detach()) {

            // THIS WORKS ??? REPPL
            $user->relationTwo()->attach($relation_id, ['user_id_one'=>$profile->id, "user_id_two"=>$logged_id]);

            return array(["response"=>"relation two was succesfully updated."]);

        } else {
            // THIS IS ALSO IMPORTANT WHEN CREATING THE RELATION!!!!
            // depending on which id (user or profile id is higher !! we either do relationOne attach or relationTwo attach)
            return array(['response' => 'No relation was found']);
        }
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
     
        $posts = Post::where('user_id', '=', auth()->id())->with('likedPosts')->get();
        return response()->json($posts);
    }


        /*
    * Get all users except the logged one in ^^
    */
    public function showPost ($id) {
        $post = Post::where('id', '=', $id)->with("comments", "comments.user", "likedPosts")->get();
        return response()->json($post);
    }

    /*
    * Like or dislike a post
    */
    public function likePost (Request $request) {

        $post_id = $request->input('post_id');
        $user_id = auth()->id();

        // check if the user likes the following/sent post id
        $likedPost = LikedPost::where('user_id', '=', $user_id)->where('post_id', "=", $post_id)->first();

        // if post is liked -> delete it like else create a like
        if($likedPost) {
            $likedPost->delete();
            return $likedPost;
        } else {
            $like = LikedPost::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
            ]);
            return $like;
        }
    }

    /*
    *   Delete a post
    */
    public function deleteUserPost ($id) {
        Post::where('id', $id)->where('user_id',  auth()->user()->id)->delete();
        $response = array('response' => "Your post has been deleted!", 'success' => true);
        return $response;
    }

    /* ------- | ** CLEANER FROM HERE ON ** | ------ */

    /* 
    * POST REVIEW ON USER PROFILE
    */

    public function postReview(Request $request) {
        
        $review = Review::create([
            'comment' => $request->input('comment'),
            'score' => $request->input('rating'),
            'user_id' => $request->input('id'),
            'reviewer_id' => auth()->user()->id,
        ]);

        $response = array('response' => 'Your review has been posted!', 'succes' => true);
        return $response;
    }

    public function createComment(Request $request) {

        $comment = Comment::create([
            'comment' => $request->input('comment'),
            'user_id' => auth()->user()->id,
            'post_id' => $request->input('post_id'),
        ]);

        $response = array('response' => 'Your comment has been posted!', 'succes' => true);
        return $response;
    }

    public function createPost(Request $request) {

        $image = base64_encode($request->input('image'));

        $user_id = auth()->user()->id;

        $post = Post::create([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'text' => $request->input('text'),
            'image' => $request->input('image'),
            'user_id' => $user_id,
        ]);

        return $post;
        $response = array('response' => 'Your comment has been posted!', 'succes' => true);
        return $response;
    }

    /*
    * Get all logged in users game data
    */
    public function showUserGameData () {

        $data = UserGameData::where('user_id', '=', auth()->user()->id)->with("game", "data")->paginate(8);
        return response()->json($data);
    }

        /*
    *  user adds games to their collection
    */
    public function addUserGame (Request $request) {
        // attach the game to the user
        // 

        $game_id = $request->input('game_id');
        $user_id = auth()->id();

        if($request->input('data_id')) {
            // update it            
            Data::where('id', '=', $id)->update(array(
                'username' => $request->input('username'),
                'data' => $request->input('data'),
            ));
            return array(['response' => 'Your game data was updated.']);
        } else {
            // create it
            $data = Data::create([
                'username' => $request->input('username'),
                'data' => $request->input('data')
            ]);
    
            $gameUserData = GameUserData::where('game_id', "=", $game_id)->where('user_id', "=", $user_id)->first();

            if($gameUserData) {
                return array(['response' => 'This game user data exist.']);
            } else {
                // Create a new gameuserdata
                $newGameUserData = GameUserDat::create([
                    'data_id' => $data->id,
                    'user_id' => $user_id,
                    "game_id" => $game_id,
                ]);
                return array(['response' => 'Game user data was created.']);
            }
        }
    }

    /*
    *  user removes games to their collection
    */
    public function removeUserGame (Request $request) {
        // remove/detach the game from user

        $game_id = $request->input('game_id');
        $user_id = auth()->id();

        $gameUserData = GameUserData::where('game_id', "=", $game_id)->where('user_id', "=", $user_id)->first();
        $data_id = $gameUserData->data_id;
        $gameUserData->delete();
        
        $data = Data::where('data_id', "=", $data_id)->first();
        $data->delete();
    }


    /*
    * Get all logged in users receiven-reviews
    */
    public function showUserReviews () {

        $data = Review::where('user_id', '=', auth()->user()->id)->paginate(4);
        return response()->json($data);
    }

       /*
    * Get all logged in users receiven-reviews
    */
    public function showPostedReviews () {

        $data = Review::where('reviewer_id', '=', auth()->user()->id)->paginate(4);
        return response()->json($data);
    }

        /*
    * Get all games
    */
    public function showQueueGames () {

        $games = Game::with('options')->get();
        return response()->json($games);
    }

    public function queue(Request $request) {

        // checks if a lobby with similar code/name exists else create
        $lobby = Lobby::firstOrCreate([
            'name' => $request->input('name'),
            'code' => $request->input('code')
        ]);


        // checks if a new lobby was creates
        if($lobby->wasRecentlyCreated) {
            
            // attaches user to that newly created lobby/pivot
            $user_id = auth()->user()->id;
            $lobby->users()->attach($user_id);
                        
            $response = array('response' => 'You just entered the Lounge', 'succes' => true);
            return $response;

        } else {
            // checks if the user already has a lobby -> sends that lobby id to the lounge
            if(!$lobby->users()->wherePivot('user_id','=',  auth()->user()->id)->count() > 0) {

                // gets the lobby and checks how many users it has
                $lobbyId = $lobby->id;
                $users = $lobby->users()->wherePivot('lobby_id','=', $lobbyId)->get();
                if(count($users) < 5) {

                    // attaches user to that newly created lobby/pivot
                    $user_id = auth()->user()->id;
                    $lobby->users()->attach($user_id);

                    return array('response' => 'This lobby already exists, user has been added to the lobby', 'succes' => true, 'data' => $lobby->id);
                } else {
                    return array('response' => 'Lobby is full create a new one', 'succes' => true, 'data' => $lobby->id);
                    // TODO::CREATE A NEW LOBBY IF THE OTHER ONE ALREADY HAS 5 USERS !! 
                }
            } else {
                return array('response' => 'user already has a lobby.', "succes" => true, "data" => $lobby->id);
            } 
        } 
    }

    public function lounge($id) {

        $lobby = Lobby::where('id', $id)->with('users')->get();
        return response()->json($lobby);

    }

    public function exitLounge () {
        // finds the logged in user
        $user = User::find(auth()->user()->id);
        
        // checks if user has any active lobbies
        $userLobby = User::where('id', auth()->user()->id)->with('lobbies')->first();
        
        // gets the lobby user is in
        if(count($userLobby->lobbies)) {
            $userLobbyId = $userLobby->lobbies[0]->id;       

            // finds the users active lobby
            $lobby = Lobby::find($userLobbyId);

            // detach that user from that lobby
            $user->lobbies()->wherePivot('user_id','=', auth()->user()->id)->detach();

            // gets all the users in that lobby
            $lobbies = $lobby->users()->wherePivot('lobby_id','=', $userLobbyId)->get();

            // counts how many users that active lobby has
            $length = count($lobbies);

            // if the lobby has 0 users deletes it else the user just gets cleared from that lobby
            if(!$length) {
                // delete the lobby
                Lobby::where('id', $userLobbyId)->delete();
                return response()->json(['response' => "your lobby has been cleared.", 'succes' => true]);
            }
            
            return response()->json(['response' => "User has exited the lobby.", 'succes' => true]);
        }
        return response()->json(['data' => "User was not in a lobby.", 'succes' => true]);
        // else 
        
        //return array('response' => 'User just existed the lobby', 'succes' => true);
    }
    
    /*
    * Get all messages for a user
    */
    public function showMessagesFor ($id) {

        $messages = Message::where(function($query) use($id) {
            $query->where('from', $id)
                ->where('to',  auth()->user()->id);
        })
        ->orWhere(function($query) use($id) {
            $query->where('to', $id)
                ->where('from',  auth()->user()->id);
        })
        ->orderBy('id', 'asc')->get();

        //$messagess = $messages->merge($messages2)->sort('id');
        return response()->json($messages);
    }

    public function messagingAuth(Request $request)
    {

        if(!auth()->user()) {
            return response(null, 401);
        }

        $channel_name = $request->input('channel_name');
        $socket_id = $request->input('socket_id');

        $auth = $this->pusher->socket_auth($channel_name, $socket_id);

        return response()->json(json_decode($auth));
    }

    /*
    * send message
    */
    public function sendMessageTo (Request $request) {

        $message = Message::create([
            'from' => auth()->user()->id,
            'to' => $request->friend_id,
            'text' => $request->text,
        ]);

        $user = Auth::user();

        $this->pusher->trigger('private-messages'.$request->friend_id, 'NewMessage', $message);
        //event(new NewMessage($message));
        //event(new MyEvent($message));

        return response()->json($message);
    }

    public function nightmode (Request $request) {
        // first create settings else if exists!
        // then update

        //$mode = $request->input('mode');
        $mode = false;

        $setting = Setting::where('user_id', "=", auth()->user()->id)->first();

        if($setting) {
            Setting::where('user_id', '=', auth()->user()->id)->update(array(
                'nightmode' => $mode,
            ));
        } else {
            $settings = Setting::create([
                'user_id' => auth()->user()->id,
                'nightmode' => $mode,
            ]);
        }
    }
    
}
