@extends('app')

@section('content')
<div class="container-fluid">
    <div class='mt-2 mb-4'>
        <h2>Comments</h2>
    </div>
    <div>

        <table id="datatable-buttons" class="table table-dark table-bordered">
            <thead class="thead-darklight">
                <tr>
                    <th>Id</th>
                    <th>Comment</th>
                    <th>Commenter</th>
                    <th>Post</th>
                    <th>Created</th>
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
                    <td><a href="{{ route('comments.show', $comment->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-pencil" title="Delete"></i>Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop