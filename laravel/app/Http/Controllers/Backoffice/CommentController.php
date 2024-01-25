<?php


namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Contracts\JWTSubject;


class CommentController extends Controller
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
        $comments = Comment::with('user', 'post')->get();

        return view('backoffice.comments.comment_show', compact('comments'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $params = [
                'comment' => $comment,
            ];
            return view('backoffice.comments.comment_delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('templates.' . '404');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->forceDelete();

            return redirect()->route('comments.index')->with('success', "A Comment with the ID of <strong>$comment->id</strong> and comment of<strong>$comment->comment</strong> has successfully been deleted from the database.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('templates.' . '404');
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
