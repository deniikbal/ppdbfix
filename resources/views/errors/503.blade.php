<!doctype html>

<html lang="en">


<head>


    <!-- META -->
    <meta charset="utf-8">
    <meta name="robots" content="noodp">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- PAGE TITLE -->
    <title>Maintenance</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&amp;subset=latin-ext" rel="stylesheet">

    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins503.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main503.css') }}">


</head>


<body>


    <!-- PRELOADER -->
    {{-- <div class="preloader">

        <!-- SPINNER -->
        <div class="spinner">

            <div class="bounce-1"></div>
            <div class="bounce-2"></div>
            <div class="bounce-3"></div>

        </div>
        <!-- /SPINNER -->

    </div> --}}
    <!-- /PRELOADER -->


    <!-- HERO -->
    <div class="hero">


        <!-- FRONT CONTENT -->
        <div class="front-content">


            <!-- CONTAINER MID -->
            <div class="container-mid">


                <!-- ANIMATION CONTAINER -->
                <div class="animation-container animation-fade-down" data-animation-delay="0">

                    <img class="img-responsive logo" width="150" height="150"
                        src="{{ asset('assets/img/logosma.png') }}" alt="image" margin=>

                </div>
                <!-- /ANIMATION CONTAINER -->


                <!-- ANIMATION CONTAINER -->
                <div class="animation-container animation-fade-right" data-animation-delay="300">

                    <h1>Sedang dalam Pemeliharaan</h1>

                </div>
                <!-- /ANIMATION CONTAINER -->


                <!-- ANIMATION CONTAINER -->
                <div class="animation-container animation-fade-left" data-animation-delay="600">

                    <p class="subline">Maaf atas ketidaknyamanan ini, tetapi kami sedang melakukan beberapa pemeliharaan
                        saat ini. kami akan segera kembali online!</p>

                </div>
                <!-- /ANIMATION CONTAINER -->


                <!-- ANIMATION CONTAINER -->
                <div class="animation-container animation-fade-up" data-animation-delay="900">

                    <!-- <div class="open-popup">Notify Me</div> -->

                </div>
                <!-- /ANIMATION CONTAINER -->


            </div>
            <!-- /CONTAINER MID -->


            <!-- FOOTER -->
            <div class="footer">


                <!-- ANIMATION CONTAINER -->
                <div class="animation-container animation-fade-up" data-animation-delay="1200">

                    <p>© PPDB SMA TELKOM {{ Carbon\carbon::now()->format('Y') }} | Design by Admin</p>

                </div>
                <!-- /ANIMATION CONTAINER -->


            </div>
            <!-- /FOOTER -->


        </div>
        <!-- /FRONT CONTENT -->
    </div>
    <!-- /HERO -->


    <!-- POPUP ( SUBSCRIBE ) -->
    <div class="popup">

    </div>
    <!-- /POPUP ( SUBSCRIBE ) -->


    <!-- JAVASCRIPTS -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins503.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main503.js') }}"></script>


</body>


</html>
