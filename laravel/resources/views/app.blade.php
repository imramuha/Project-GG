<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project GG - Backoffice</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/14005d5905.js" crossorigin="anonymous"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
    <div id="app">
        @guest
        <nav class="navbar header-top navbar-dark bg-darklight">
            <div class="container-fluid">
                <a href="{{route('dashboard')}}" class="navbar-brand">Project GG</a>
                @else
                <nav class="navbar header-top navbar-expand-sm navbar-dark bg-darklight">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{route('dashboard')}}"><img class="mb-2 mt-2" src="{{URL::asset('logo.svg')}}" alt="logo" height="35px"> </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-content" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="menu-content">
                            @endguest

                            @guest
                            <ul class="navbar-nav ml">
                                <li class="navbar-brand">
                                    <span class="fas fa-toolbox">&nbsp;</span>BACKOFFICE
                                </li>
                            </ul>
                            @else

                            <ul id="menu-content" class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                <li class="nav-item dropdown">
                                    ({{ Auth::user()->role->name }}) [ {{ Auth::user()->username }} ] <span class="fa fa-user">&nbsp;</span>


                                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                                        <a class="divider"></a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><span class="fas fa-sign-out-alt">&nbsp;</span>
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                            @endguest
                        </div>
                    </div>
                </nav>

                @guest
                @else
                <div class="nav-side-menu navbar-fixed-left">
                    <div class="menu-list">
                        <ul>
                            <div>
                                &nbsp;
                            </div>
                            <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}"><span>Reports</span><i class="fa fa-flag" aria-hidden="true"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('news.index')}}"><span>News</span><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                </a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}"><span>Users</span> <i class="pull-right align-items-center fas fa-users"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('reviews.index')}}"><span>Reviews</span> <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </a></li>

                            <li class="nav-item"><a class="nav-link" href="{{route('posts.index')}}"><span>Posts</span> <i class="fa fa-comment" aria-hidden="true"></i>
                                </a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('comments.index')}}"><span>Comments</span> <i class="pull-right align-items-center fa fa-comments-o"></i></a></li>

                            <li class="nav-item"><a class="nav-link" href="{{route('games.index')}}"><span>Games</span> <i class="pull-right align-items-center fas fa-gamepad"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('criteria.index')}}"><span>Criteria</span> <i class="pull-right align-items-center fa fa-check-square-o"></i></a></li>

                            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span> {{ __('Logout') }} </span> <i class="fas fa-sign-out-alt"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>


            </div>
            @endguest

            @guest
            <div class="main" role="main">
                @include('templates.alerts') @yield('content')
            </div>
            @else
            <div class="maincontainer" role="main">
                @include('templates.alerts') @yield('content')
            </div>

            @endguest
</body>

</html>