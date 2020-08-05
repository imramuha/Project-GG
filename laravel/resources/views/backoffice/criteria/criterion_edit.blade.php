@extends('app') @section('content')
<div class="container-fluid creation-form">
    <h2 class="mt-2 mb-5">Update a Criteria</h2>
    <form method="post" action="{{ route('criteria.update', $criterion->id) }}" data-parsley-validate class="form-horizontal">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

            <div class="form-row">

                <div class="col-5">
                    <label>Name</label>
                    <input type="text" value="{{ old( 'name', $criterion->name ) }}" name="name" class="form-control">
                    @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }} <br /></span>
                    @endif
                </div>

                <div class="col-6 ml-auto">
                    <label>Game</label>
                    <select id="inlineFormCustomSelect" class="form-control custom-select mr-sm-2" name="game_id">
                        @if (count($criterion->games) > 0)
                            <option value="{{ $criterion->games[0]->id }}" selected>Current: {{ $criterion->games[0]->name }}</option>
                        @else
                            <option value="" selected disabled>Select the game it belongs to</option>
                        @endif
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

        <div class="mt-5">
            <div class="float-left">
                <a href="{{route('criteria.index')}}" class="btn btn-secondary btn-xs float-right"><i class="fa fa-chevron-left"></i> Back </a>
            </div>

            <div class="float-right">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input name="_method" type="hidden" value="PUT">
                <button type="submit" class="btn btn-success">Updates</button>
            </div>
        </div>
    </form>
</div>
@stop