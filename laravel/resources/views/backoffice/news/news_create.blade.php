@extends('app')

@section('content')
<div class="container-fluid creation-form">

    <h2 class="mt-2 mb-5">Add a news article</h2>

    <form method="post" action="{{ route('news.store') }}" data-parsley-validate class="form-horizontal">
        @csrf

        <div class="form-row mb-3">

            <div class="col">
                <strong>Title</strong>
                <input type="text" name="title" class="form-control">
            </div>

        </div>

        <div class="form-row">

            <div class="col">
                <strong>Text</strong>
                <textarea rows="5" type="text" type="text" name="text" class="form-control"></textarea>
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

        <div class="form-group mt-5">
            <div class="float-left">
                <a href="{{route('news.index')}}" class="btn btn-secondary btn-xs float-right"><i class="fa fa-chevron-left"></i> Back </a>
            </div>
            <div class="float-right">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    </form>

</div>
@stop