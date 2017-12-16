<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BidPro</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    @include('inc.landingNav')
    @yield('content')
</body>
    <script src="{{ asset('js/landing-page/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/landing-page/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('js/landing-page/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/landing-page/creative.min.js') }}"></script>
</html>