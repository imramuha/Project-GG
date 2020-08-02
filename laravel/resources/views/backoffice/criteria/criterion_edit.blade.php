@extends('app') @section('content')
<div class="jumbotron bg-darklight">
    <h2 class="display-4 mb-5">Edit a Criteria <a href="{{route('criteria.index')}}" class="btn btn-info btn-xs pull-right  mt-4"><i class="fa fa-chevron-left"></i> Back </a></h2>
    <form method="post" action="{{ route('criteria.update', $criterion->id) }}" data-parsley-validate class="form-horizontal form-label-left pb-5">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

            <div class="form-row">

                <div class="col-6">
                    <label>Name</label>
                    <input type="text" value="{{ old( 'name', $criterion->name ) }}" name="name" class="form-control">
                    @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }} <br /></span>
                    @endif
                </div>

                <div class="col-6">
                    <label>Game</label>
                    <select id="inlineFormCustomSelect" class="form-control custom-select mr-sm-2" name="game_id">
                        <option value="{{ $criterion->games[0]->id }}" selected>Current: {{ $criterion->games[0]->name }}</option>
                        @foreach($games as $game)
                        <option value="{{ $game->id }}">
                            {{ $game->name }}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('game_id'))
                    <span class="help-block">{{ $errors->first('game_id') }} <br /></span> <br />
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group mt-5 mb-5">
            <div class="pull-left" >
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input name="_method" type="hidden" value="PUT">
                <button type="submit" class="btn btn-success">Updates</button>
            </div>
        </div>
    </form>
</div>
@stop