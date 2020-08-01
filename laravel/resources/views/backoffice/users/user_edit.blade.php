@extends('app') @section('content')
<div class="jumbotron bg-darklight">
    <h2 class="display-4 mb-5">Edit a User <a href="{{route('users.index')}}" class="btn btn-info btn-xs pull-right  mt-4"><i class="fa fa-chevron-left"></i> Back </a></h2>
{{ $user }}
{{ $roles }}
{{ $statuses }}
   <form method="post" action="{{ route('users.update', $user->id) }}" data-parsley-validate class="form-horizontal form-label-left pb-5">

        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
           
            <div class="form-row">
               
                <div class="col-4">
                    <label>Username</label>
                    <input type="text" value="{{ old( 'username', $user->username) }}" name="username" class="form-control">
                    @if ($errors->has('username'))
                    <span class="help-block">{{ $errors->first('username') }} <br /></span>
                    @endif
                </div>

                <div class="col-4">
                    <label>Username</label>
                    <input type="text" value="{{ old( 'email', $user->email) }}" name="email" class="form-control">
                    @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}   <br /></span> <br />
                    @endif
                </div>

                <div class="col-4">
                    <label>Status</label>
                    <select id="inlineFormCustomSelect" class="form-control custom-select mr-sm-2" name="status_id">
                        <option value="" selected disabled>Current: {{ old( 'status_id', $user->status->name) }}</option>
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

                <div class="col-4">
                    <label>Role</label>
                    <select id="inlineFormCustomSelect" class="form-control custom-select mr-sm-2" name="role_id">
                        <option value="" selected disabled>Current: {{ old( 'role_id', $user->roles[0]->name) }}</option>
                        @foreach($roles as $role)
                        <option value="{{ $status->id }}">
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

        <div class="form-group mt-5 mb-5">
            <div class="pull-left" >
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input name="_method" type="hidden" value="PUT">
                <button type="submit" class="btn btn-success">Updates</button>
            </div>
        </div>
    </form>
</div>
@stop