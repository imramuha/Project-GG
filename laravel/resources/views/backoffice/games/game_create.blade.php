@extends('app')

@section('content')
<div class="jumbotron  bg-darklight">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="display-4 mb-5">Add a new game<a href="{{route('games.index')}}" class="btn btn-info btn-xs pull-right  mt-4"><i class="fa fa-chevron-left"></i> Back </a></h2>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('games.store') }}" data-parsley-validate enctype="multipart/form-data" class="form-horizontal form-label-left">
                    @csrf
                   
                    <div class="form-row">

                          <div class="col">
                            <strong>Name</strong>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col">
                        <strong>Game Image</strong>
                            <div class="col-md-6">
                                <input id="image" accept="image/*" type="file" class="form-control" name="image">
                            </div>
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
