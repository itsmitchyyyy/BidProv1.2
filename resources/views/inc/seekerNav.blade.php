<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="{{ route('seeker') }}"><img src="/img/bidprologo.png" style="width:100px"></a>
<div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item{{ Request::is('seeker') ? ' active' : ''}}">
      <a class="nav-link" href="{{ route('seeker') }}">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav item{{ Request::is('seeker/projects') ? ' active' : ''}}">
      <a href="{{ route('projects') }}" class="nav-link">Projects</a>
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
      <a href="#" class="nav-link" data-toggle="dropdown" id="dropDownMessage">
        <i class="fa fa-envelope-o" data-count="0"></i>
        <span class="text-danger" id="counts" class="notify-count">0</span>
      </a>
      <div class="dropdown-menu dropdown-menu-right"  aria-labelledBy="dropdownMessage">
      <h6 class="dropdown-header">You have (<span class="notif-count">0</span>) notifications</h6>
      <div class="text-center" style="font-size:12px"><small><a href="#" class="text-dark">See all messages</a></small></div>
        <!-- <h6 class="dropdown-header">You have (<span class="notif-count">0</span>) notifications</h6>
        <a href="#">
          <div class="message-center">
            <div class="user-img ml-2">
              <img src="/uploads/blank.png" alt="avatar" style="border-radius:50%">
            </div>
            <div class="mail-content">
              <h5><b></b></h5>
              <span class="mail-desc"></span>
            </div>
          </div>
        </a>
        <hr>
        <div class="dropdown-footer text-center">
          <a href="#" class="text-dark"><strong>See all messages</strong></a>
        </div>-->
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if(Auth::user()->avatar !== null)
        <img src="/{{ Auth::user()->avatar }}" style="width:30px;border-radius:50%" class="mr-sm-1">
        @else
        <img src="/uploads/blank.png" style="width:30px;border-radius:50%" class="mr-sm-1">
        @endif
        {{ ucwords(Auth::user()->name) }}
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="{{ route('profile',['id' => Auth::user()->id]) }}"><i class="ti-user"></i> Profile</a>
        <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a>
      </div>
    </li>
    </ul>
  </div>
</nav>

@section('scripts')
<script>
  var wrapper = $('.notifications');
  var toggle = wrapper.find('a[data-toggle]');
  var element = toggle.find('i[data-count]');
  var counter = parseInt(element.data('count'));
  var notifications = wrapper.find('div.dropdown-menu');
  var notifier = wrapper.find('#counts');

  //notifier.hide();

  var pusher = new Pusher('9ab3129dae2df45ee2fc',{
    cluster: 'ap1',
    encrypted: true
  });

  var channel = pusher.subscribe('bid-notify');
  channel.bind('App\\Events\\BidNotified', function(data){
    var header = notifications.html();
   // var footer = ``;
    //alert(existing);
    var newnotifications = `
        <a href="#">
          <div class="message-center">
            <div class="user-img ml-2">
              <img src="{{ Auth::user()->avatar }}" alt="avatar" style="border-radius:50%">
            </div>
            <div class="mail-content">
              <h5><b></b>`+data.message+`</h5>
              <span class="mail-desc"></span>
            </div>
          </div>
        </a>
        <hr>
    `;
    notifications.html(header + newnotifications);
    counter += 1;
    element.attr('data-count', counter);
    wrapper.find('.notif-count').text(counter);
    wrapper.find('#counts').text(counter);
  });
 // wrapper.hide();
</script>
@endsection