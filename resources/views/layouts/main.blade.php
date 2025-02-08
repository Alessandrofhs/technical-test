<!DOCTYPE html>
<html lang="en">


<head>
    <!--  Title -->
    <title>@yield('title')</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('dist/images/logos/ecodocs-logo-mini.png') }}" />
    <!-- Owl Carousel -->
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('dist/libs/select2/dist/css/select2.min.css') }}>
    <link href="{{ asset('css/iziToast.min.css') }}" rel="stylesheet">
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href={{ asset('dist/css/style-green.min.css') }} />
    <script src="{{ asset('js/highcharts.js') }}"></script>
    <script src={{ asset('dist/libs/moment-js/moment.js') }}></script>
    @stack('styles')
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('dist/images/logos/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('dist/images/logos/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('partials.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('partials.header')
            <!--  Header End -->
            <div class="container-fluid mw-100">
                @yield('main')
            </div>
        </div>
        <div class="dark-transparent sidebartoggler"></div>
        <div class="dark-transparent sidebartoggler"></div>
    </div>

    <!--  Mobilenavbar -->
    @include('partials.mobile-nav')

    <!--  Search Bar -->
    @include('partials.searchbar')

    <!--  Customizer -->
    <!--  Import Js Files -->
    @stack('scripts')
    <script src={{ asset('dist/libs/jquery/dist/jquery.min.js') }}></script>
    <script src={{ asset('dist/libs/jquery-ui/dist/jquery-ui.min.js') }}></script>
    <script src={{ asset('dist/libs/simplebar/dist/simplebar.min.js') }}></script>
    <script src={{ asset('dist/libs/jquery.repeater/jquery.repeater.min.js') }}></script>
    <script src={{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}></script>
    <!--  core files -->
    <script src={{ asset('dist/js/app.init.js') }}></script>
    <script src={{ asset('dist/js/app.min.js') }}></script>
    <script src={{ asset('dist/js/sidebarmenu.js') }}></script>
    <script src={{ asset('dist/js/repeater-init.js') }}></script>
    <script src={{ asset('dist/js/custom.js') }}></script>
    <script src={{ asset('js/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('js/dataTables.bootstrap4.min.js') }}></script>
    <script src={{ asset('js/owl.carousel.min.js') }}></script>
    <!--  current page js files -->
    <script src={{ asset('dist/js/dashboard.js') }}></script>
    <script src={{ asset('dist/js/plugins/toastr-init.js') }}></script>
    <script src={{ asset('dist/libs/select2/dist/js/select2.full.min.js') }}></script>
    <script src={{ asset('dist/js/forms/select2.init.js') }}></script>
    <script src={{ asset('js/bootstrap4-toggle.min.js') }}></script>
    <script src={{ asset('dist/js/moment.js') }}></script>
</body>

</html>
