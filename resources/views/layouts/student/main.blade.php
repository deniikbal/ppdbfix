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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/assets/img/favicon.png') }}">

    <title>@yield('title')</title>

    <!-- vendor css -->
    <link href="{{ asset('/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/lib/jqvmap/jqvmap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/lib/typicons.font/typicons.css') }}" rel="stylesheet">
    <link href="{{ asset('/lib/prismjs/themes/prism-vs.css') }}" rel="stylesheet">
    <link href="{{ asset('/lib/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/lib/select2/css/select2.min.css') }}" rel="stylesheet">


    <!-- DashForge CSS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/dashforge.dashboard.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css"
        rel="stylesheet">
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body>

    <aside class="aside aside-fixed">
        <div class="aside-header">
            <a href="../../index.html" class="aside-logo">PPDB<span>SMATEL</span></a>
            <a href="" class="aside-menu-link">
                <i data-feather="menu"></i>
                <i data-feather="x"></i>
            </a>
        </div>
        <div class="aside-body">
            <div class="aside-loggedin">
                @include('layouts.student.sidebarlog')
            </div><!-- aside-loggedin -->
            @include('layouts.student.sidebar')
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
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                                <li class="breadcrumb-item"><a href="#">@yield('main')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('data')</li>
                            </ol>
                        </nav>
                        <h4 class="mg-b-0 tx-spacing--1">@yield('title')</h4>
                    </div>
                    <div class="d-none d-md-block">
                        <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i
                                class="far fa-clock"></i>
                            {{ \Carbon\Carbon::now()->format('D, d M Y H:i:s') }}</button>
                    </div>
                </div>

                <div class="row row-xs">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.script')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-CqGqrjaolSRsf7c7"></script>

    <!-- append theme customizer -->
    <script src="{{ asset('/lib/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('/assets/js/dashforge.settings.js') }}"></script>
    @yield('script')
    @stack('scripts')
    @stack('addon-script')
    <script>
        //message with toastr
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}');
        @elseif (session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
</body>

</html>
