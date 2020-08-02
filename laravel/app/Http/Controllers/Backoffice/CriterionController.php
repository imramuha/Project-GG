<?php


namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criterion;
use App\Models\Game;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Contracts\JWTSubject;


class CriterionController extends Controller
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
        $criteria = Criterion::with('games')->get();

        return view('backoffice.criteria.criterion_show', compact('criteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = Game::get()->all();

        return view('backoffice.criteria.criterion_create', compact('games'));
      
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
            'game_id' => 'required'
        ]);
    
        $criterion = Criterion::create([
            'name' => $request->input('name'),
        ]);

        // attaching criteria to that certain game
        $game_id = $request->input('game_id');
        $criterion->games()->attach($game_id);

        return redirect()->route('criteria.index')->with('success', "A new Critrion with the name of<strong>$criterion->name></strong> has successfully been added to the database.");
   
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
            $criterion = Criterion::findOrFail($id);
            $params = [
                'criterion' => $criterion,
            ];
            return view('backoffice.criteria.criterion_delete')->with($params);
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
            $criterion = Criterion::with('games')->findOrFail($id);

            $games = Game::get();

            $params = [
                'criterion' => $criterion,
            ];

            return view('backoffice.criteria.criterion_edit', compact('games'))->with($params);
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
            $criterion = Criterion::findOrFail($id);
    
            // attaching criteria to that certain game
            $game_id = $request->input('game_id');
            $criterion->games()->sync($game_id);

            $criterion->name = $request->input('name');
            $criterion->save();

            return redirect()->route('criteria.index')->with('success', "A Criteria with the name of <strong>$criterion->name</strong> has successfully been updated.");
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
            $criterion = Criterion::findOrFail($id);
            $criterion->forceDelete();
            
            return redirect()->route('criteria.index')->with('success', "A Criteria with the name of <strong> $criterion->name</strong> has successfully been deleted from the database.");
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
