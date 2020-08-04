@extends('app')

@section('content')
<div class="container-fluid">
    <div class='mt-2 mb-4'>
        <h2>Posts</h2>
    </div>
    <div>
        <table id="datatable-buttons" class="table table-dark table-bordered">
            <thead class="thead-darklight">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Text</th>
                    <th>Creator</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post['id'] }}</td>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['subtitle'] }}</td>
                    <td>{{ $post['text'] }}</td>
                    <td> {{ $post['user']->username }} </td>
                    <td>{{ $post['created_at'] }}</td>
                    <td><a href="{{ route('posts.delete', ['id' => $post->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-pencil" title="Delete"></i>Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop