<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        {{ config('app.name') }} &mdash; {{ $title ?? '' }}
    </title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages." />
    <meta name="keywords"
        content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template" />
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/dashboard/images/favicon.svg') }}" type="image/x-icon">

    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/fonts/material.css') }}">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/plugins/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/dashboard/plugins/select2/css/select2-bootstrap-5-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/customizer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/layout-horizontal.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/layout-modern.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/jquery-confirm/jquery-confirm.min.css') }}">
    @stack('styles')
</head>

<body class="modern-layout ">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Mobile header ] start -->
    <div class="pc-mob-header pc-header">
        <div class="pcm-logo">
            <img src="{{ asset('assets/dashboard/images/logo.svg') }}" alt="" class="logo logo-lg">
        </div>
        <div class="pcm-toolbar">
            <a href="#!" class="pc-head-link" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>
            <a href="#!" class="pc-head-link" id="header-collapse">
                <i data-feather="more-vertical"></i>
            </a>
        </div>
    </div>
    <!-- [ Mobile header ] End -->

    <!-- [ navigation menu ] start -->
    @include('layouts.navigation')
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    @include('layouts.header')
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pcoded-content">
            @yield('content')
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="{{ asset('assets/dashboard/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/pcoded.js') }}"></script>
    <!-- Datatable Js -->
    <script src="{{ asset('assets/dashboard/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/select2/select2.full.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
