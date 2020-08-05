@extends('app')

@section('content')
<div class="container no-access">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header no-access-header">UNAUTHORIZED</div>
                <div class=" no-access-body card-body">
                    You have to be an ADMIN or a MODERATOR to be able to log into the backoffice!
                </div>
                <a class="nav-link" href="{{route('login')}}">GO BACK</a>
            </div>
        </div>
    </div>
</div>
@endsection
