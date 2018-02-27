<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mobile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('mobile/materialize/css/materialize.min.css') }}">
    <script src="{{ asset('mobile/materialize/js/jquery.js') }}"></script>
    <script src="{{ asset('mobile/materialize/js/materialize.min.js') }}"></script>
    @stack('css')
</head>
<body style="background:#ccc">
    @yield('content')
</body>

    @stack('scripts')
</html>