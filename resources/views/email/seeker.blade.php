<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/img/bidprologo.png" type="image/x-icon">
    <title>BidPro</title>
    <link rel="stylesheet" href="{{ asset('css/seeker/seeker.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="card w-50">
            <div class="card-header">Hi {{ $receiver }}</div>
            <div class="card-block">
                <p class="card-text">
                    Your project {{ $project_name }} is now ready. <br> Check it out now @ BidPro.com
                <p class="card-text">
                    This message is sent automatically by BidPro.
                </p>
            </div>
        </div>
    </div>
</body>
</html>