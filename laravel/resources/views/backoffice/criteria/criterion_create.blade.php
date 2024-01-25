@extends('app')

@section('content')
<div class="container-fluid creation-form">

    <h2 class="mt-2 mb-5">Add a Criterion</h2>


    <form method="post" action="{{ route('criteria.store') }}" data-parsley-validate class="form-horizontal form-label-left">
        @csrf

        <div class="form-row">

            <div class="col-5">
                <strong>Name</strong>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="col-6 ml-auto">
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

        <div class="mt-4">
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

        <div class="form-group mt-5">
            <div class="float-left">
                <a href="{{route('criteria.index')}}" class="btn btn-secondary btn-xs float-right"><i class="fa fa-chevron-left"></i> Back </a>
            </div>
            <div class="float-right">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    </form>

</div>
@stop