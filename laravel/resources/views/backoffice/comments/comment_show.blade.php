@extends('app')

@section('content')
<div class="jumbotron bg-darklight">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="display-4 mb-5">Comments</h2>
                </div>
                <div class="x_content">
    
                <table id="datatable-buttons" class="table table-dark table-bordered">
                        <thead class="thead-darklight">
                            <tr>
                                <th>Id</th>
                                <th>Comment</th>
                                <th>Commenter</th>
                                <th>Post</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($comments as $comment)                       
                            <tr>
                            <td>{{ $comment['id'] }}</td>
                            <td>{{ $comment['comment'] }}</td>
                            <td>{{ $comment['user']->username }}</td>
                            <td>id: {{ $comment['post_id'] }} <br> title: {{ $comment['post']->title }}</td>
                            <td>{{ $comment->created_at }}</td>
                                <td><a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-pencil" title="Delete"></i>Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
             </div>
        </div>
    </div>
</div>
@stop