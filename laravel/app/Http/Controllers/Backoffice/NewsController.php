<?php


namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Contracts\JWTSubject;


class NewsController extends Controller
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
        $news = News::orderBy('created_at', 'DESC')->get();
        $user = User::with('role')->find(auth('web')->user()->id);    
        $userRole = $user->role->name;
        return view('backoffice.news.news_show', compact('news', 'userRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.news.news_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:8',
            'text' => 'required|min:16',
        ]);


    
        $news = News::create([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'user_id' => auth('web')->user()->id
        ]);

        return redirect()->route('news.index')->with('success', "The news item with the title <strong>$news->title</strong> has successfully been added to the database.");
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
            $news = News::findOrFail($id);
            $params = [
                'news' => $news,
            ];
            return view('backoffice.news.news_edit')->with($params);
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
                'title' => 'required|min:8',
                'text' => 'required|min:16',
            ]);

            $news = News::findOrFail($id);
            $news->title = $request->input('title');
            $news->text = $request->input('text');
            $news->user_id = auth('web')->user()->id;
            $news->save();

            return redirect()->route('news.index')->with('success', "The News item with title <strong>$news->title</strong> has successfully been updated.");
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
            $news = News::findOrFail($id);
            $news->forceDelete();
            
            return redirect()->route('news.index')->with('success', "A News Item with the ID of <strong> $news->id</strong> and title of<strong>$news->title</strong> has successfully been deleted from the database.");
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
