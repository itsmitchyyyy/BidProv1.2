<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/img/bidprologo.png" type="image/x-icon">
    <title>BidPro</title>
    <link rel="stylesheet" href="{{ asset('css/seeker/seeker.css') }}">
    @stack('css')
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
        .hidden{
          display:none;
        }
    </style>
</head>
<body>
    @include('inc.bidderNav')
    @yield('content')
    
</body>
<script src="{{ asset('js/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
@yield('scripts')
<!-- NOTIFICATION SCRIPT -->
<script>
      var wrapper = $('.notifications');
      var toggle = wrapper.find('a[data-toggle]');
      var element = toggle.find('i[data-count]');
      var counter = parseInt(element.data('count'));
      var notifications = wrapper.find('#menuItems');
        /* if(counter = 0){
         wrapper.hide();
       }  */

      var pusher = new Pusher('9ab3129dae2df45ee2fc',{
        cluster: 'ap1',
        encrypted: true,
      })

      var channel = pusher.subscribe('bid-notify');
      channel.bind('App\\Events\\BidNotified', function(data){
        var existing = notifications.html();
        var newnotification = `<a href="http://">
        <div class="message-center">
          <div class="user-img ml-2">
            <img src="/uploads/blank.png" alt="avatar" style="border-radius:50%;">
          </div>
          <div class="mail-content">
            <h5><b>`+data.message+`</b></h5>
            <span class="mail-desc">View</span>
          </div>
        </div>
        </a>
        <hr>`;
        notifications.html(existing + newnotification);
      counter += 1;
      element.attr('data-count', counter);
      wrapper.find('.notif-count').text(counter);
      // wrapper.show();
      });
     
      //notifications.hide();
     // wrapper.hide();
  </script>
</html>