<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::with('user')->get();
        return view('dashboard', compact('reports'));
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
            $report = Report::findOrFail($id);
            $report->forceDelete();
            
            return redirect()->route('dashboard')->with('success', "A report with the type of<strong> $report->type</strong> and ID of <strong>$report->id</strong> has successfully been deleted from the database.");
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('templates.'.'404');
            }
        }
    }
    
}
