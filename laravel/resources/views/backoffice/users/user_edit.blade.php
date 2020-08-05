@extends('app') @section('content')
<div class="container-fluid creation-form">
    <h2 class="mt-2 mb-5">Edit a User</h2>
    <form method="post" action="{{ route('users.update', $user->id) }}" data-parsley-validate class="form-horizontal">

        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

            <div class="form-row">

                <div class="col-5">
                    <label>Username</label>
                    <input type="text" value="{{ old( 'username', $user->username) }}" name="username" class="form-control">
                    @if ($errors->has('username'))
                    <span class="help-block">{{ $errors->first('username') }} <br /></span>
                    @endif
                </div>

                <div class="col-5 mb-3 ml-auto">
                    <label>Email</label>
                    <input type="text" value="{{ old( 'email', $user->email) }}" name="email" class="form-control">
                    @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }} <br /></span> <br />
                    @endif
                </div>

                <div class="col-5">
                    <label>Status</label>
                    <select id="inlineFormCustomSelect" class="form-control custom-select mr-sm-2" name="status_id">
                    @if (count($criterion->status) > 0)
                        <option value="{{ $user->status->id }}" selected>Current: {{ $user->status->name }}</option>
                        @else
                            <option value="" selected disabled>Select a role for this user</option>
                        @endif
                       @foreach($statuses as $status)
                        <option value="{{ $status->id }}">
                            {{ $status->name }}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('status_id'))
                    <span class="help-block">{{ $errors->first('status_id') }} <br /></span> <br />
                    @endif
                </div>

                <div class="col-5 ml-auto">
                    <label>Role</label>
                    <select id="inlineFormCustomSelect" class="form-control custom-select mr-sm-2" name="role_id">
                        @if (count($criterion->role) > 0)
                            <option value="{{ $user->role->id }}" selected>Current: {{ $user->role->name }}</option>
                        @else
                            <option value="" selected disabled>Select a role for this user</option>
                        @endif
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('role_id'))
                    <span class="help-block">{{ $errors->first('role_id') }} <br /></span> <br />
                    @endif
                </div>
            </div>
        </div>

        <div class=" mt-5">
            <div class="float-left">
                <a href="{{route('users.index')}}" class="btn btn-secondary danger btn-xs float-right"><i class="fa fa-chevron-left"></i> Back </a>
            </div>
            <div class="float-right">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input name="_method" type="hidden" value="PUT">
                <button type="submit" class="btn btn-success btn-xs">Update</button>
            </div>
        </div>
    </form>
</div>
@stop