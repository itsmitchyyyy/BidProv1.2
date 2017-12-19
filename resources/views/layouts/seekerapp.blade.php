<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/img/bidprologo.png" type="image/x-icon">
    <title>BidPro</title>
    <style>
        .wew:hover{
            cursor:pointer;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/seeker/seeker.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    @include('inc.seekerNav')
    @yield('content')
    
</body>
<script>
     @if(count($errors))
            $('#myModal').modal('show');
            $('#myModal').data('bs.modal').handleUpdate();
     @endif
    </script>
    <script>
        var maxChar = 255;
        $('#charLeft').text(maxChar + ' characters left');
        $('#details').keyup(function(){
            var textLength = $(this).val().length;
            if(textLength >= maxChar){
                $('#charLeft').text('You have reached the limit of ' + maxChar + ' characters');
            } else {
                var count = maxChar - textLength;
                $('#charLeft').text(count + ' characters left');
            }
        });
    </script>
    <script>
        $('#cost').change(function(){
            this.value = parseFloat(this.value).toFixed(2);
        });
    </script>
   
</html>