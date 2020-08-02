@extends('app')

@section('content')
<div class="jumbotron bg-darklight">
    <h2 class="display-4 mb-5">Update an existing Game <a href="{{route('games.index')}}" class="btn btn-info btn-xs pull-right  mt-4"><i class="fa fa-chevron-left"></i> Back </a></h2>
       
    <form method="post" action="{{ route('games.update', $game->id) }}" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left pb-5">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
           
            <div class="form-row">

                <div class="col-4">
                    <strong>Name</strong>
                    <input type="text" value="{{ old( 'game', $game->name) }}" name="name" class="form-control">
                    @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('game') }} <br /></span>
                    @endif        
                </div>   

            

                <div class="col-4">
                    <strong>Current Image</strong> <br>
                    <img src="data:image/jpeg;base64,{{ $game->image }}"  style="width: 100px; height: autopx;"/>
                </div>

                <div class="col-4">
                        <strong>Game Image</strong>
                            <div class="col-md-6">
                                <input id="image" accept="image/*" type="file" class="form-control" name="image">
                            </div>
                        </div>

        </div>

        <div class="form-group mt-5 mb-5">
            <div class="pull-left" >
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input name="_method" type="hidden" value="PUT">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
    </form>
</div>
@stop