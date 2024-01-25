@extends('app')

@section('content')
<div class="container-fluid creation-form">
    <h2 class="mt-2 mb-5">Update a Game</h2>

    <form method="post" action="{{ route('games.update', $game->id) }}" enctype="multipart/form-data" data-parsley-validate class="form-horizontal">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

            <div class="form-row mb-3">

                <div class="col-12">
                    <strong>Name</strong>
                    <input type="text" value="{{ old( 'game', $game->name) }}" name="name" class="form-control">
                    @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('game') }} <br /></span>
                    @endif
                </div>
            </div>
            <div class="form-row">

                <div class="col-6">
                    <strong>Game Image</strong>
                    <input id="image" accept="image/*" type="file" class="form-control" name="image">
                </div>


                <div class="col-6 ml-auto">
                    <strong>Current Image</strong> <br>
                    <img src="data:image/jpeg;base64,{{ $game->image }}" style="width: 100px; height: auto;" />
                </div>

            </div>

            <div class="mt-5">
                <div class="float-left">
                    <a href="{{route('games.index')}}" class="btn btn-secondary btn-xs float-right"><i class="fa fa-chevron-left"></i> Back </a>
                </div>

                <div class="float-right">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input name="_method" type="hidden" value="PUT">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
    </form>
</div>
@stop