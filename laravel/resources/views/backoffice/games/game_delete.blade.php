@extends('app')

@section('content')
<div class="container-fluid creation-form">

    <h2 class="mt-2 mb-5">Confirm deletion of a game</h2>
    <p>Are you sure you want to delete a Game by the name of <strong>{{$game->name}}</strong>?</strong></p>


    <div class="form-row mt-5">
        <div class=" col-6 float-left">
            <a href="{{route('games.index')}}" class="btn btn-secondary btn-xs"><i class="fa fa-chevron-left"></i> Back </a>
        </div>
        <div class="col-6 float-right text-right">
            </form>
            <form method="POST" action="{{ route('games.destroy', $game->id) }}">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class="btn btn-danger">Yes I'm sure. Delete</button>
            </form>
        </div>
    </div>

</div>
@stop