<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

    <title>{{$title ?? ''}}</title>

    <!-- vendor css -->
    <link href="{{asset('/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/dashforge.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/dashforge.auth.css')}}">
</head>
<body>

<header class="navbar navbar-header navbar-header-fixed">
    <a href="#" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand">
        <a href="../../index.html" class="df-logo">PPDB<span>SMATEL</span></a>
    </div><!-- navbar-brand -->
    <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
            <a href="../../index.html" class="df-logo">PPDB<span>SMATEL</span></a>
            <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div><!-- navbar-menu-header -->
    </div><!-- navbar-menu-wrapper -->
    <div class="navbar-right">
        @if(request()->routeIs('register'))
            <a href="{{route('login')}}" class="btn
        btn-log"><i data-feather="log-in"></i> <span>Log In</span></a>
        @elseif(request()->routeIs('login'))
            <a href="{{route('register')}}" class="btn
        btn-buy"><i data-feather="user-plus"></i> <span>Register</span></a>
        @else
            <a href="{{route('login')}}" class="btn
        btn-log"><i data-feather="log-in"></i> <span>Log In</span></a>
        @endif
    </div><!-- navbar-right -->
</header><!-- navbar -->

@yield('content')

<footer class="footer">
    <div>
        <span>&copy; {{Carbon\carbon::now()->format('Y')}} DashForge v1.0.0. </span>
        <span>Created by <a href="http://themepixels.me">ThemePixels</a></span>
    </div>
    <div>
        <nav class="nav">
            <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
            <a href="../../change-log.html" class="nav-link">Change Log</a>
            <a href="https://discordapp.com/invite/RYqkVuw" class="nav-link">Get Help</a>
        </nav>
    </div>
</footer>

<script src="{{asset('/lib/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/lib/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('/lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

<script src="{{asset('/assets/js/dashforge.js')}}"></script>

<!-- append theme customizer -->
<script src="{{asset('/lib/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('/assets/js/dashforge.settings.js')}}"></script>
<script>
    $(function () {
        'use script'

        window.darkMode = function () {
            $('.btn-white').addClass('btn-dark').removeClass('btn-white');
        }

        window.lightMode = function () {
            $('.btn-dark').addClass('btn-white').removeClass('btn-dark');
        }

        var hasMode = Cookies.get('df-mode');
        if (hasMode === 'dark') {
            darkMode();
        } else {
            lightMode();
        }
    })
</script>
</body>
</html>
