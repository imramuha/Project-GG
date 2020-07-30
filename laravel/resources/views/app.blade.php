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
    <div id="app" class="w-100 h-100">
    This includes the navigation -> that shows login
    <div class="nav-side-menu navbar-fixed-left">
    <div class="menu-list">
        @guest
        @else
        <ul>
            <div>
                &nbsp;
            </div>
            <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}">Users<i class="pull-right align-items-center fas fa-home"></i></a></li>
        </ul>
        @endguest
    </div>
    <div class="main">
    @yield('content')
    </div>
   </div>
        
</body>

</html>