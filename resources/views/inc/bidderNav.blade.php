<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="{{ route('bidder') }}"><img src="/img/bidprologo.png" style="width:100px"></a>
<div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item{{ Request::is('bidder') ? ' active' : ''}}">
      <a class="nav-link" href="{{ route('bidder') }}">Home <span class="sr-only">(current)</span></a>
    </li>
   <!--<li class="nav-item">
      <a class="nav-link" href="#">Features</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Pricing</a>
    </li>-->
    </ul>
    <ul class="navbar-nav">
    <li class="nav-item dropdown notifications">
     <a href="" class="nav-link" data-toggle="dropdown" id="navbarDropdownMessage" href="#">
        <i class="fa fa-envelope-o" data-count="0"></i>
        <span class="text-danger notif-count">0</span>
      </a>
      <div id="menuItems" class="dropdown-menu dropdown-menu-right" aria-labelledBy="navbarDropdownMessage">
       <h6 class="dropdown-header">You have (<span class="notif-count">0</span>) new messages</h6>
       <!-- <a href="http://">
        <div class="message-center">
          <div class="user-img ml-2">
            <img src="/uploads/blank.png" alt="" style="border-radius:50%;">
          </div>
          <div class="mail-content">
         
            <h5><b>Asd</b></h5>
            <span class="mail-desc">ASDSAD</span>
          </div>
        </div>
<<<<<<< HEAD
        </a> -->
=======
        </a> 
>>>>>>> seeker
        <hr>
        <div class="text-center">
        <a href="" class="text-dark"><strong>See all messages </strong><i class="fa fa-angle-right"></i></a>
        </div>-->
      </div>
     
    </li>
    <li class="nav-item dropdown{{ Request::is('bidder/profile/'.Auth::user()->id) ? ' active' : ''}}">
      <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if(Auth::user()->avatar !== null)
        <img src="/{{ Auth::user()->avatar }}" style="width:30px;border-radius:50%" class="mr-sm-1">
        @else
        <img src="/uploads/blank.png" style="width:30px;border-radius:50%" class="mr-sm-1">
        @endif
        {{ ucwords(Auth::user()->name) }}
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href=""><i class="ti-email"></i> Inbox</a>
        <a class="dropdown-item" href="{{ route('bidderprofile',['id' => Auth::user()->id]) }}"><i class="ti-user"></i> Profile</a>
        <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a>
      </div>
    </li>
    </ul>
  </div>
</nav>

@section('scripts')
<script src="https://js.pusher.com/3.1/pusher.min.js"></script>
  <script>
      var wrapper = $('.notifications');
      var toggle = wrapper.find('a[data-toggle]');
      var element = toggle.find('i[data-count]');
      var counter = parseInt(element.data('count'));
      var notifications = wrapper.find('#menuItems');
       if(counter <= 0){
        wrapper.hide();
      } 

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
            <img src="/uploads/blank.png" alt="" style="border-radius:50%;">
          </div>
          <div class="mail-content">
            <h5><b>`+data.message+`</b></h5>
            <span class="mail-desc">ASDSAD</span>
          </div>
        </div>
        </a>`;
        notifications.html(newnotification + existing);
      counter += 1;
      element.attr('data-count', counter);
      wrapper.find('.notif-count').text(counter);
      wrapper.show();
      });
     
      //notifications.hide();
     // wrapper.hide();
  </script>
@endsection