@extends('app')

@section('content')
<div class="jumbotron bg-darklight">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="display-4 mb-5">News <a href="{{route('news.create')}}" class="btn btn-primary btn-xs pull-right  mt-4"><i class="fa fa-plus"></i> Create New </a></h2>
                </div>
                <div class="x_content">
                {{ $userRole }}
                <table id="datatable-buttons" class="table table-dark table-bordered">
                    <thead class="thead-darklight">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Text</th>
                            <th>Created at</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($news as $newsItem)  
                            <tr>
                            <td>{{ $newsItem->id }}</td>
                                <td>{{ $newsItem->title }}</td>
                                <td>{{ $newsItem->text }}</td>
                                <td>{{ $newsItem->created_at }}</td>
                                <td>{{ $newsItem->user->username}}</td>
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
        </div>
    </div>
</div>
@stop