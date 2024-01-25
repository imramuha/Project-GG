<?php


namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Contracts\JWTSubject;


class GameController extends Controller
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
        $games = Game::with('criteria')->get();

        return view('backoffice.games.game_show', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.games.game_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          //
          $this->validate($request, [
            'name' => 'required|min:1',
        ]);

        $path = $request->file('image')->getRealPath();
        $image = file_get_contents($path);      
        $base64 = base64_encode($image);


    
        $game = Game::create([
            'name' => $request->input('name'),
            'image' => $base64,
        ]);

        return redirect()->route('games.index')->with('success', "A new game with the name of<strong>$game->name></strong> has successfully been added to the database.");
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $game = Game::findOrFail($id);
            $params = [
                'game' => $game,
            ];
            return view('backoffice.games.game_delete')->with($params);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $game = Game::findOrFail($id);
            $params = [
                'game' => $game,
            ];
            return view('backoffice.games.game_edit')->with($params);
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
            $path = $request->file('image')->getRealPath();
            $image = file_get_contents($path);      
            $base64 = base64_encode($image);

            $game = Game::findOrFail($id);
            $game->name = $request->input('name');
            $game->image = $base64;
            $game->save();

            return redirect()->route('games.index')->with('success', "A game with the name of <strong>$game->name</strong> has successfully been updated.");
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $game = Game::findOrFail($id);
            $game->forceDelete();
            
            return redirect()->route('games.index')->with('success', "A game with the name of <strong> $game->name</strong> has successfully been deleted from the database.");
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
