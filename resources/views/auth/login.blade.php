<!DOCTYPE html>
<html lang="en">

<head>

    <title>
        {{ config('app.name') }} &mdash; Sign In
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
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/customizer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/layout-horizontal.css') }}">

    <style>
        /* auth custom */
        .auth-custom {
            background-image: url('https://kalisanen.com/admin_page/images/bg-login2.jpg');
            background-position: center;
            background-size: cover;
        }
    </style>
</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper auth-custom">
    <div class="auth-content">
        <div class="card">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="material-icons-two-tone">email</i>
                                </span>
                                <input type="text" name="login" class="form-control"
                                    placeholder="Email or Username">
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-text">
                                    <i class="material-icons-two-tone">lock</i>
                                </span>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>

                            <button type="submit" class="btn btn-block btn-primary mb-4" style="width: 100%">
                                Login
                            </button>

                            <p class="mb-2 text-muted">
                                Lupa kata sandi? <a href="auth-reset-password.html" class="f-w-400">Reset</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="{{ asset('assets/dashboard/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/plugins/feather.min.js') }}"></script>

<script>
    feather.replace();
</script>

</body>

</html>
