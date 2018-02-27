<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mobile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('materialize/materialize.css') }}">
    @stack('css')
</head>
<body>
    
    @yield('content')
</body>
    <script src="{{ asset('materialize/jquery.js') }}"></script>
    <script src="{{ asset('materialize/materialize.js') }}"></script>
    @stack('scripts')
</html>