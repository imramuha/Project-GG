@extends('app')

@section('content')
        <div class="x_panel">
            <div class="x_title">
                <h2 class="display-4 mb-5">Users <a href="{{route('users.create')}}" class="btn btn-primary btn-xs pull-right  mt-4"><i class="fa fa-plus"></i> Create New </a></h2>
            </div>
            <div class="x_content">        
                <table id="datatable-buttons" class="table table-dark table-bordered">
                {{ $userRole }}
                    <thead class="thead-darklight">
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)  
                            <tr>
                            <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>@foreach($user->roles as $role)
                                        {{$role->name}} 
                                    @endforeach</td>
                                <td>
                                    @if($userRole === 'Admin')
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>Edit</a>
                                        <a href="{{ route('users.delete', ['id' => $user->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-pencil" title="Delete"></i>Delete</a>
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