@extends('app')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2 class="display-4 mb-5">Criteria <a href="{{route('criteria.create')}}" class="btn btn-primary btn-xs pull-right  mt-4"><i class="fa fa-plus"></i> Create New </a></h2>
        </div>
        <div class="x_content">        
            <table id="datatable-buttons" class="table table-dark table-bordered">
                <thead class="thead-darklight">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Games</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($criteria as $criterion)  
                        <tr>
                        <td>{{ $criterion->id }}</td>
                            <td>{{ $criterion->name }}</td>
                            <td>
                            @foreach ($criterion->games as $game)
                                {{ $game->name }}  
                            @endforeach                           
                            </td>
                            <td>{{ $criterion->created_at }}</td>
                            <td>{{ $criterion->updated_at }}</td>
                            <td>
            
                                    <a href="{{ route('criteria.edit', $criterion->id ) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>Edit</a>
                                    <a href="{{ route('criteria.delete', $criterion->id ) }}" class="btn btn-danger btn-xs"><i class="fa fa-pencil" title="Delete"></i>Delete</a>
                            </td>
                        </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@stop