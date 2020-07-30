@extends('app')

@section('content')
<div class="jumbotron bg-darklight">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="display-4 mb-5">Users <a href="{{route('users.create')}}" class="btn btn-primary btn-xs pull-right  mt-4"><i class="fa fa-plus"></i> Create New </a></h2>
                </div>
                <div class="x_content">
                {{ $users }}
          
                    <table id="datatable-buttons" class="table table-dark table-bordered">
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
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>@foreach($user->roles as $role)
                                        {{$role->name}} 
                                    @endforeach</td>
                                <td>
                                    Buttons after role
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