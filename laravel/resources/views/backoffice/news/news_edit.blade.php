@extends('app')

@section('content')
<div class="jumbotron bg-darklight">
    <h2 class="display-4 mb-5">Update a News item <a href="{{route('news.index')}}" class="btn btn-info btn-xs pull-right  mt-4"><i class="fa fa-chevron-left"></i> Back </a></h2>
        {{ $news->id }}
    <form method="post" action="{{ route('news.update', $news->id) }}" data-parsley-validate class="form-horizontal form-label-left pb-5">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
           
            <div class="form-row">

                <div class="col-4">
                    <strong>Title</strong>
                    <input type="text" value="{{ old( 'news', $news->title) }}" name="title" class="form-control">
                    @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('news') }} <br /></span>
                    @endif        
                </div>   

                <div class="col-4">
                    <strong>Text</strong>
                    <input type="text" name="text" value="{{ old( 'news', $news->text) }}" class="form-control" >
                    @if ($errors->has('text'))
                    <span class="help-block">{{ $errors->first('news') }} <br /></span>
                    @endif        
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