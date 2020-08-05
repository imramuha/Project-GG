@extends('app')

@section('content')
<div class="container-fluid creation-form">

    <h2 class="mt-2 mb-5">Confirm deletion of a comment</h2>
    <p>Are you sure you want to delete the following comment: <strong>{{$comment->comment}}</strong>?</strong></p>


    <div class="form-row mt-5">
        <div class=" col-6 float-left">
            <a href="{{route('comments.index')}}" class="btn btn-secondary btn-xs"><i class="fa fa-chevron-left"></i> Back </a>
        </div>
        <div class="col-6 float-right text-right">
            <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

</div>
@stop