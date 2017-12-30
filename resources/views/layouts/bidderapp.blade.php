<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/img/bidprologo.png" type="image/x-icon">
    <title>BidPro</title>
    <link rel="stylesheet" href="{{ asset('css/seeker/seeker.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
        .wew:hover{
            cursor:pointer;
        }
        .search{
            padding:10px;
            font-family: FontAwesome, "Open Sans", Verdana, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: inherit;

        }
    </style>
</head>
<body>
    @include('inc.bidderNav')
    @yield('content')
    
</body>
<script>
    $(".proposeBtn").on('click',function(e){
        var id = $(this).data('id');
        e.preventDefault();
        $('.viewModal')
            .modal('hide')
            .on('hidden.bs.modal',function(e){
                $('#proposeModal'+id).modal('show');
                $(this).off('hidden.bs.modal');
            });
    });
</script>
<script>
    $('#price').change(function(){
        this.value = parseFloat(this.value).toFixed(2);
    })
</script>
</html>