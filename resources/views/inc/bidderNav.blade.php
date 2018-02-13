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
    <li class="nav-item">
      <a href="{{ route('bidderworks') }}" class="nav-link">My Works</a>
    </li>
    <li class="nav-item{{ Request::is('proposals') ? ' active' : ''}}">
      <a href="{{ route('bids') }}" class="nav-link">My Bids</a>
    </li>
   <!--<li class="nav-item">
      <a class="nav-link" href="#">Features</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Pricing</a>
    </li>-->
    </ul>
    <ul class="navbar-nav">
    <!-- <li class="nav-item dropdown">
    <a href="#" class="nav-link" data-toggle="dropdown" id="navbarDropdownInbox">
      <i class="ti-email"></i>
      <span class="text-danger">0</span>
    </a>

    <div id="inboxItems" class="dropdown-menu dropdown-menu-right" aria-laballedBy="navbarDropdownInbox">
      <h6 class="dropdown-header">You have <span>(0)</span> new messages</h6>
      <a href="http://">
        <div class="message-center">
          <div class="user-img ml-2">
            <img src="/uploads/blank.png" alt="" style="border-radius:50%;">
          </div>
          <div class="mail-content">
         
            <h5><b>Asd</b></h5>
            <span class="mail-desc">ASDSAD</span>
          </div>
        </div>
        </a>
        <hr>
        <div class="text-center">
        <a href="" class="text-dark"><strong>See all messages </strong><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
    </li> -->
    @inject('notifications', 'App\Http\Controllers\NotificationController')
    <li class="nav-item dropdown notifications">
     <a href="" class="nav-link" data-toggle="dropdown" id="navbarDropdownMessage" href="#">
        <i class="fa fa-bell" style="color:orange" data-count="{{ $notifications->countNotification() }}"></i>
        <span class="text-danger notif-count">{{ $notifications->countNotification() }}</span>
      </a>
      <div id="menuItems" class="dropdown-menu dropdown-menu-right" aria-labelledBy="navbarDropdownMessage">
       <h6 class="dropdown-header">You have (<span class="notif-count">{{ $notifications->countNotification() }}</span>) new notifications</h6>
       <div class="text-center" style="font-size:12px"><small><a href="{{ route('viewNotification') }}" class="text-dark">See all messages</a></small></div>
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
        </a> -->
        <!-- <hr>
        <div class="text-center">
        <a href="" class="text-dark"><strong>See all messages </strong><i class="fa fa-angle-right"></i></a>
        </div> -->
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
        <!-- <a class="dropdown-item" href=""><i class="ti-email"></i> Inbox</a> -->
        <a class="dropdown-item" href="{{ route('bidderprofile',['id' => Auth::user()->id]) }}"><i class="ti-user"></i> Profile</a>
        <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a>
      </div>
    </li>
    </ul>
  </div>
</nav>