@extends('app')

@section('content')
<div class="container-fluid creation-form">
    <h2 class="mt-2 mb-5">Update an article</h2>
    <form method="post" action="{{ route('news.update', $news->id) }}" data-parsley-validate class="form-horizontal">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

            <div class="form-row  mb-3">
                <div class="col-12">
                    <strong>Title</strong>
                    <input type="text" value="{{ old( 'news', $news->title) }}" name="title" class="form-control">
                    @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('news') }} <br /></span>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="col-12">
                    <strong>Text</strong>
                    <textarea rows="5" type="text" name="text" class="form-control" >{{ old( 'news', $news->text) }}</textarea>
                    @if ($errors->has('text'))
                    <span class="help-block">{{ $errors->first('news') }} <br /></span>
                    @endif
                </div>
            </div>


            <div class="mt-5">
                <div class="float-left">
                    <a href="{{route('news.index')}}" class="btn btn-secondary btn-xs float-right"><i class="fa fa-chevron-left"></i> Back </a>

                </div>
                <div class="float-right">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input name="_method" type="hidden" value="PUT">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
    </form>
</div>
@stop