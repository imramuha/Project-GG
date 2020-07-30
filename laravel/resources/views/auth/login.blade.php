@extends('app')

@section('content')
        <div class="container-fluid text-center"> 
        <div class="mt-5"></div>
                <img class="mb-4 mt-4" src="{{URL::asset('img/logo.png')}}" alt="logo" width="100px" height="75px">
                <h1 class="h3 mb-3 mt-4 font-weight-normal">{{ __('Welcome to the back-office') }}</h1>
                
                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                        @csrf
                            <label for="email" class="sr-only" placeholder="Email address">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="Email address">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback text-white">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            <label for="password" class="sr-only">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required  placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback text-white">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        
                                <button type="submit" class="btn btn-lg btn-outline-light btn-block">
                                    {{ __('Login') }}
                                </button>

                    </form>

            </div>
@endsection
