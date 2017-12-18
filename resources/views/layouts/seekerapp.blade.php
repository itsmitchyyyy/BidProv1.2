<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BidPro</title>
    <style>
        .wew:hover{
            cursor:pointer;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/bidder/bidder.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    @include('inc.seekerNav')
    @yield('content')
    
</body>
<script>
     @if(count($errors))
            $('#myModal').modal('show');
        @endif
        $('#myModal').modal('bs.modal').handleUpdate();
       
    </script>
   
</html>