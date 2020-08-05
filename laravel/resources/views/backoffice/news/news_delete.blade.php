@extends('app')

@section('content')
<div class="container-fluid creation-form">

    <h2 class="mt-2 mb-5">Confirm deletion of a News item</h2>
    <p>Are you sure you want to delete a News item by the title of <strong>{{$news->title}}</strong>?</strong></p>


    <div class="form-row mt-5">
        <div class=" col-6 float-left">
            <a href="{{route('news.index')}}" class="btn btn-secondary btn-xs"><i class="fa fa-chevron-left"></i> Back </a>
        </div>
        <div class="col-6 float-right text-right">
            <form method="POST" action="{{ route('news.destroy', $news->id) }}">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

</div>
@stop