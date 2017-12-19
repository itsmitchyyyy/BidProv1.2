<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BidPro</title>
    <link rel="shortcut icon" href="/img/bidprologo.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!--<script src="{{ asset('js/app.js') }}"></script>-->
</head>
<body id="page-top">
    @include('inc.landingNav')
    @yield('content')
</body>
    <!--<script src="{{ asset('js//bower_components/jquery/dist/jquery.min.js') }}"></script>-->
    <script src="{{ asset('js/landing-page/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/landing-page/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/landing-page/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/landing-page/scrollreveal/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('js/landing-page/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/landing-page/js/creative.min.js') }}"></script>

   
</html>