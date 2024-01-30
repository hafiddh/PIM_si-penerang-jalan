<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dompet : Payment Admin Template" />
    <meta property="og:title" content="Dompet : Payment Admin Template" />
    <meta property="og:description" content="Dompet : Payment Admin Template" />
    <meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Street Light : Login</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('') }}template/admin/images/favicon.png" />
    <link href="{{ asset('') }}template/admin/css/style.css" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('') }}template/admin/vendor/toastr/css/toastr.min.css">

</head>

<body class="vh-100"
    style="background-image: url({{ asset('') }}template/landingpage/images/main-slider/slider-3.jpg);">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.html"><img
                                                src="{{ asset('') }}template/admin/images/streetlight.png"
                                                alt="" style="width: 30%;"></a>
                                    </div>
                                    {{-- <h4 class="text-center mb-4">Masuk</h4> --}}
                                    <form action="{{ route('postlogin') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" class="form-control" value="" name="username"
                                                placeholder="Username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" value="" name="password"
                                                placeholder="Password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('') }}template/admin/vendor/global/global.min.js"></script>
    <script src="{{ asset('') }}template/admin/js/custom.min.js"></script>
    <script src="{{ asset('') }}template/admin/js/dlabnav-init.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('') }}template/admin/vendor/toastr/js/toastr.min.js"></script>

    @if ($message = Session::get('success'))
        <script>
            $(document).ready(function() {
                toastr['success']('', '{{ $message }}', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                });
            });
        </script>
    @endif

    @if ($message = Session::get('error'))
        <script>
            $(document).ready(function() {
                toastr['error']('', '{{ $message }}', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true
                });
            });
        </script>
    @endif

    @if ($message = Session::get('message'))
        <script>
            $(document).ready(function() {
                toastr['message']('', '{{ $message }}', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true
                });
            });
        </script>
    @endif

</body>

</html>
