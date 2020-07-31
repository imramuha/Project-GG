@extends('app')

@section('content')
<div class="jumbotron bg-darklight">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="display-4 mb-5">Comments <a href="{{route('games.create')}}" class="btn btn-primary btn-xs pull-right  mt-4"><i class="fa fa-plus"></i> Create New </a></h2>
                </div>
                <div class="x_content">
                {{ $comments }}
                </div>
             </div>
        </div>
    </div>
</div>
@stop