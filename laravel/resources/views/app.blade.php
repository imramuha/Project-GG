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


    <!-- Styles -->
    <link href="../sass/app.scss" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
    <div id="app" class="conter-fluid">
        <div class="row">
            @guest
            <main class="col-md-12">
                this one is or not lgged in users
                @yield('content')
            </main>
            @else
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Home - Reports <i class="pull-right align-items-center fas fa-home"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('news.index')}}">News<i class="pull-right align-items-center fas fa-home"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}">Users<i class="pull-right align-items-center fas fa-home"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('posts.index')}}">Posts<i class="pull-right align-items-center fas fa-home"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('games.index')}}">Games<i class="pull-right align-items-center fas fa-home"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('reviews.index')}}">Reviews<i class="pull-right align-items-center fas fa-home"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('comments.index')}}">Comments<i class="pull-right align-items-center fas fa-home"></i></a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"><span class="fas fa-sign-out-alt">&nbsp;</span>
                                            {{ __('Logout') }}
                                </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form></li>
                    </ul>    
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                @include('templates.alerts') @yield('content')
            </main>
            @endguest
        </div>
    </div>
</body>

</html>