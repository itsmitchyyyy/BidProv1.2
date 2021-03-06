<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .img{
            height:150px;
            width:200px;
            -o-object-fit:contain;
        }
    </style>
</head>
<body>
@if(Auth::user()->status == 1)
    @include('inc.bidderNav')
    @yield('content')
    @else
    <script>
            "{{ session()->flush() }}";
            swal({
                title: "Notification",
                text: "Your account has been blocked by the admin",
                icon: "warning"
            }).then(function(value){
                window.location = "{{ URL::to('/') }}";
            });
    </script>
    @endif
</body>
<script src="{{ asset('js/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
@yield('scripts')
@stack('scripts')
<!-- NOTIFICATION SCRIPT -->
<script>
      var wrapper = $('.notifications');
      var toggle = wrapper.find('a[data-toggle]');
      var element = toggle.find('i[data-count]');
      var counter = parseInt(element.data('count'));
      var notifications = wrapper.find('div.dropdown-menu');
      var pusher = new Pusher('9ab3129dae2df45ee2fc',{
        cluster: 'ap1',
        encrypted: true,
      })

      var channel = pusher.subscribe('bid-notify');
      channel.bind('App\\Events\\BidNotified', function(data){
        console.log(data.avatar);
    console.log(data.link);
        var existing = notifications.html();
        var newnotifications = `
        <a href="`+data.link+`">
          <div class="message-center">
            <div class="user-img ml-2">
              <img src="{{ asset('`+data.avatar+`') }}" alt="avatar" style="border-radius:50%">
            </div>
            <div class="mail-content">
              <h5><b>`+data.message+`</b></h5>
              <span class="mail-desc"><small>View</small></span>
            </div>
          </div>
        </a>
        <hr>
    `;
      notifications.html(existing + newnotifications);
      counter += 1;
      element.attr('data-count', counter);
      wrapper.find('.notif-count').text(counter);
      wrapper.find('#counts').text(counter);
      });
  </script>
  <script>
    $(document).ready(function(){
        $('[data-tooltip="true"]').tooltip();
    });
</script>
   
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
    var pusher = new Pusher('9ab3129dae2df45ee2fc',{
        cluster: 'ap1',
        encrypted: true,
      });

    var payment = pusher.subscribe('payment-notify');
        payment.bind('App\\Events\\PaymentEvent', function(data){
            swal("You have a payment",""+data.message)
        });
    </script>
</html>