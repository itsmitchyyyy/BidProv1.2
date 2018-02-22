
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
  
    </ul>
    <ul class="navbar-nav">
    
    @inject('notifications', 'App\Http\Controllers\NotificationController')
    <li class="nav-item dropdown notifications">
     <a href="" class="nav-link" data-toggle="dropdown" id="navbarDropdownMessage" href="#">
     <i class="fa fa-bell" style="color:orange" data-count="{{ $notifications->countNotification() }}"></i>
        <span class="text-danger" id="counts" class="notify-count">{{ $notifications->countNotification() }}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-right"  aria-labelledBy="dropdownMessage">
      <h6 class="dropdown-header">You have (<span class="notif-count">{{ $notifications->countNotification() }}</span>) unread notifications</h6>
      <div class="text-center" style="font-size:16px"><small><a href="{{ route('viewNotification') }}" class="text-dark">See all messages</a></small></div>
       
      @foreach($notifications->navNotification() as $notify)
      <a href="#" onclick="updateNotification('{{ $notify }}')">
          <div class="message-center{{ ($notify->statuss == 'unread') ? ' list-group-item-info':' list-group-item-light' }} p-1">
            <div class="user-img ml-2 mt-2">
              <img src="/{{ $notify->avatar }}" alt="avatar" style="border-radius:50%">
            </div>
            <div class="mail-content">
              <h5><b>{{ ucwords($notify->name) }} {{ $notify->message }}</b></h5>
              <span class="mail-desc"><small>View</small></span>
            </div>
          </div>
        </a>
        <hr>
    @endforeach
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
@push('scripts')
<script>
  function updateNotification($notif_data){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var datas = JSON.parse($notif_data);
    // console.log(CSRF_TOKEN);
    $(function(){
    $.ajax({
      type: "post",
      url: "{{ route('updateNotification', ['notif_id']) }}",
      headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
      data: {
        'notif_id': datas.id
        },
      // dataType: "json",
      cache:false,
      success:function(response){
        console.log(response);
        window.location = datas.link;
      },
      error:function(response){
        console.log(response);
      }
    });
});
}
</script>
@endpush