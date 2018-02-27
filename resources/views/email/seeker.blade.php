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
            <div class="card-header">Hi <b>{{ $receiver }}</b></div>
            <div class="card-block">
                <p class="card-text">
                    Your project <b>{{ $project_name }}</b> is now ready for presentation. Details are mention below for proper meetup
                    <br>
                    <br><strong>Developer:</strong> {{ $developer }}
                    <br><strong>Contact Number:</strong> {{ $contact }}
                    <br><strong>Email:</strong> {{ $email }}
                    <br><strong>Bid Price:</strong> {{ $price }}
                    <br><strong>Awarded Date:</strong> {{ $award }}
                    <br><strong>Location:</strong> {{ $location }}
                    <br><strong>Date:</strong> {{ $date }}
                    <br><strong>Time:</strong> {{ $time }}
                <p class="card-text">
                        Contact the developer incase of changing your presentation.
                    <!-- This message is sent automatically by BidPro. -->
                </p>
            </div>
        </div>
    </div>
</body>
</html>