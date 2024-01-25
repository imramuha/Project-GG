@extends('app')

@section('content')
<div class="container-fluid creation-form">

    <h2 class="mt-2 mb-5">Add a new game</h2>

    <form method="post" action="{{ route('games.store') }}" data-parsley-validate enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf

        <div class="form-row">

            <div class="col-5">
                <strong>Name</strong>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="col-6 ml-auto">
                <strong>Game Image</strong>
                    <input id="image" accept="image/*" type="file" class="form-control" name="image">
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
                <a href="{{route('games.index')}}" class="btn btn-secondary btn-xs float-right"><i class="fa fa-chevron-left"></i> Back </a>
            </div>
            <div class="float-right">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    </form>

</div>
@stop