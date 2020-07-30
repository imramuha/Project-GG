@extends('app')

@section('content')

<div>Dashboard</div>
logout button maken
<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"><span class="fas fa-sign-out-alt">&nbsp;</span>
                                            {{ __('Logout') }}
                                </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
@endsection
