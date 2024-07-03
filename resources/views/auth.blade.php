<!DOCTYPE html>
<html lang="en">

<head>
    <title>Delshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Mukta:300,400,700') }}">
    <link rel="stylesheet" href="{{ asset('pembeli/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css') }}" crossorigin="anonymous">


    <link rel="stylesheet" href="{{ asset('pembeli/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pembeli/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('pembeli/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('pembeli/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pembeli/css/owl.theme.default.min.css') }}">


    <link rel="stylesheet" href="{{ asset('pembeli/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('pembeli/css/style.css') }}">

</head>

<body>
    <div class="site-wrap">

        @yield('content')
    </div>

    <script src="{{ asset('pembeli/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('pembeli/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('pembeli/js/popper.min.js') }}"></script>
    <script src="{{ asset('pembeli/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('pembeli/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('pembeli/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('pembeli/js/aos.js') }}"></script>

    <script src="{{ asset('pembeli/js/main.js') }}"></script>

</body>

</html>
