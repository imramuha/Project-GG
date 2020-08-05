@extends('app')

@section('content')
<div class="container-fluid text-center ">
    <img class="mb-5 logo-img" src="{{URL::asset('logo.svg')}}" alt="logo" width="100px" height="75px">
    <h1 class="h3 mt-1 font-weight-normal"><strong>a warm welcome back!</strong></h1>
    <p class="mb-3">another day, different cries</p>

    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email" class="sr-only" placeholder="Email address">{{ __('E-Mail Address') }}</label>

        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email address">

        @if ($errors->has('email'))
        <span class="invalid-feedback text-white">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif

        <label for="password" class="sr-only">{{ __('Password') }}</label>

        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

        @if ($errors->has('password'))
        <span class="invalid-feedback text-white">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif

        <button type="submit" class="btn btn-lg btn-outline-light btn-block mt-5">
            {{ __('Login') }}
        </button>

    </form>

</div>
@endsection