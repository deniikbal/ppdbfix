<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/assets/img/favicon.png') }}">

    <title>{{ $title }}</title>

    <!-- vendor css -->
    <link href="{{ asset('/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/lib/jqvmap/jqvmap.min.css') }}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/dashforge.dashboard.css') }}">
</head>

<body>

    <aside class="aside aside-fixed">
        <div class="aside-header">
            <a href="../../index.html" class="aside-logo">dash<span>forge</span></a>
            <a href="" class="aside-menu-link">
                <i data-feather="menu"></i>
                <i data-feather="x"></i>
            </a>
        </div>
        <div class="aside-body">
            <div class="aside-loggedin">
                @include('layouts.admin.sidebarlog')
            </div><!-- aside-loggedin -->
            @include('layouts.admin.sidebar')
        </div>
    </aside>

    <div class="content ht-100v pd-0">
        <div class="content-header">
            <div class="content-search">
                <i data-feather="search"></i>
                <input type="search" class="form-control" placeholder="Search...">
            </div>
            <nav class="nav">
                <a href="" class="nav-link"><i data-feather="help-circle"></i></a>
                <a href="" class="nav-link"><i data-feather="grid"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
            </nav>
        </div><!-- content-header -->

        <div class="content-body">
            <div class="container pd-x-0">
                @yield('breadcumb')
                <div class="card">
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>

            </div><!-- container -->
        </div>
    </div>

    <script src="{{ asset('/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('/lib/jquery.flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('/lib/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('/lib/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('/lib/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <script src="{{ asset('/assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('/assets/js/dashforge.aside.js') }}"></script>
    <script src="{{ asset('/assets/js/dashforge.sampledata.js') }}"></script>
    <script src="{{ asset('/assets/js/dashboard-one.js') }}"></script>

    <!-- append theme customizer -->
    <script src="{{ asset('/lib/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('/assets/js/dashforge.settings.js') }}"></script>
</body>

</html>
