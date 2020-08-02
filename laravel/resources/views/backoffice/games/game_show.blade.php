@extends('app')

@section('content')
<div class="jumbotron bg-darklight">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="display-4 mb-5">Games <a href="{{route('games.create')}}" class="btn btn-primary btn-xs pull-right  mt-4"><i class="fa fa-plus"></i> New Game </a></h2>
                </div>
                <div class="x_content">
                <table id="datatable-buttons" class="table table-dark table-bordered">
                    <thead class="thead-darklight">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Criteria</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($games as $game)  
                            <tr>
                                <td>{{ $game->id }}</td>                                
                                <td><img src="data:image/jpeg;base64,{{ $game->image }}"  style="width: 100px; height: autopx;"/></td>
                                <td>{{ $game->name }}</td>
                                <td>@foreach ($game->criteria as $criterion)  
                                        [{{ $criterion->name }}]
                                    @endforeach
                                </td>
                                <td>{{ $game->created_at}}</td>
                                <td>
                                <a href="{{ route('games.edit', ['game' => $game->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>Edit</a>
                                <a href="{{ route('games.show', $game->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i>Delete </a></td>
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