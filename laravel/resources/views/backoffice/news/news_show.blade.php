@extends('app')

@section('content')
<div class="container-fluid">
    <div class='mt-2 mb-4'>
        <h2>News <a href="{{route('news.create')}}" class="btn btn-primary btn-xs float-right"><i class="fa fa-plus"></i> Create New </a></h2>
    </div>
    <div>
        <table id="datatable-buttons" class="table table-dark table-bordered">
            <thead class="thead-darklight">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Text</th>
                    <th>Creator</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $newsItem)
                <tr>
                    <td>{{ $newsItem->id }}</td>
                    <td>{{ $newsItem->title }}</td>
                    <td>{{ $newsItem->text }}</td>
                    <td>{{ $newsItem->user->username}}</td>
                    <td>{{ $newsItem->created_at }}</td>
                    <td>{{ $newsItem->updated_at }}</td>
                    <td>
                        @if($userRole === 'Admin')
                        <a href="{{ route('news.edit', ['news' => $newsItem->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>Edit</a>
                        <a href="{{ route('news.delete', ['id' => $newsItem->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-pencil" title="Delete"></i>Delete</a>
                        @else
                        <a>Only accessible for ADMINS</a>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
@stop