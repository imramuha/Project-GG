@extends('app')

@section('content')
<div class="jumbotron  bg-darklight">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="display-4 mb-5">Add a criterion<a href="{{route('criteria.index')}}" class="btn btn-info btn-xs pull-right  mt-4"><i class="fa fa-chevron-left"></i> Back </a></h2>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('criteria.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                    @csrf
                   
                    <div class="form-row">

                          <div class="col">
                            <strong>Name</strong>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="col-4">
                            <strong>Game</strong>
                            <select id="inlineFormCustomSelect" class="form-control custom-select mr-sm-2" name="game_id">
                                <option value="" selected disabled>Choose the game you want it to attach...</option>
                                @foreach($games as $game)
                                <option value="{{ $game->id }}">
                                {{ $game->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
</div>

                        <div class="ln_solid mt-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>

                        <div class="form-group">
                            <div class="pull-left mt-2">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
