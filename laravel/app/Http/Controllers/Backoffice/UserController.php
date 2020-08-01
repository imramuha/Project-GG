<?php


namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Contracts\JWTSubject;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        //
        $users = User::with('role')->get();
    
        $user = User::with('role')->find(auth('web')->user()->id);    
        $userRole = $user->role->name;
      
        return view('backoffice.users.user_show', compact('users', 'userRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $user = User::with('status', 'role')->findOrFail($id);

            $roles = Role::get();
            $statuses = Status::get();

            $params = [
                'user' => $user,
            ];

            return view('backoffice.users.user_edit', compact('roles', 'statuses'))->with($params);
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('templates.'.'404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $this->validate($request, [
                'username' => 'required|unique:users,username,'.$id,
                'email' => 'required|email|unique:users,email,'.$id,
                'role_id' => 'required',
            ]);

            $user = User::findOrFail($id);
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->role_id = $request->input('role_id');
            $user->save();

            return redirect()->route('users.index')->with('success', "The User with username: <strong>$user->username</strong> has successfully been updated.");
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $user = User::findOrFail($id);
            $user->forceDelete();

            return redirect()->route('users.index')->with('success', "A User with the username <strong>$user->username</strong> and email <strong>$user->email</strong> has successfully been deleted from the database.");
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('templates.'.'404');
            }
        }
    }

    
    /**
     * Soft Delete a specified item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete($id)
    {

    }

        /**
     * Restore a soft deleted item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softUndelete($id)
    {

       
    }
}
