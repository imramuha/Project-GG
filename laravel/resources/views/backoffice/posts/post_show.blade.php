@extends('app')

@section('content')
<div class="jumbotron bg-darklight">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="display-4 mb-5">Posts</h2>
                </div>
                <div class="x_content">
                {{ $posts }}
          
                   <table id="datatable-buttons" class="table table-dark table-bordered">
                        <thead class="thead-darklight">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Created at</th>
                                <th>Created by</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)                       
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->subtitle }}</td>
                                <td>{{ $post->text }}</td>

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