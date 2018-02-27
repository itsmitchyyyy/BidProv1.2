@extends('layouts.mobilelayout')
@push('css')
    <style>
        html, body {height:100%;}
        body {margin:0;padding:0;}
        .btnUpload-hide{
            display:none;
        }
       
    </style>
@endpush
@section('content')
<nav>
    <div class="nav-wrapper deep-orange">
  <a href="#"  data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    
    </div>
  </nav>
  
      <ul id="slide-out" class="side-nav">
    <li>
        <div class="user-view">
      <div class="background">
      <img src="img/login-background.jpg" class="responsive-img">
      </div>
      <a href="#!user"><img class="circle" src="{{ Auth::user()->avatar }}"></a>
      <a href="#!name"><span class="white-text name">{{ ucfirst(Auth::user()->firstname) }} {{ ucfirst(Auth::user()->lastname) }}</span></a>
      <a href="#!email"><span class="white-text email">{{ Auth::user()->email }}</span></a>
    </div></li>
    <li><a href="{{ route('seeker.profile') }}"><i class="material-icons">account_circle</i>Profile</a></li>
    <li><a href="{{ route('seeker.projects') }}"><i class="material-icons">description</i>Project</a></li>
    <li><a href="{{ route('mobile.logout') }}"><i class="material-icons">power_settings_new</i>Logout</a></li>
  </ul>
      <div style="position:relative;top:0;left:0;height:100%;width:100%;">
           <div style="border:1px solid rgba(0,0,0,.25);height:100%">
               <div style="margin-left:auto;margin-right:auto;width:100%;padding:10px">
               <div style="text-align:center">
                   @if(session()->get('success'))
               <div id="card-alert" class="card green lighten-5">
                      <div class="card-content green-text">
                        <p>SUCCESS : {{ session()->get('success') }}</p>
                      </div>
                    </div>
                @endif
                <label for="image_avatar">
               <img src="{{ Auth::user()->avatar }}" id="imgAvatar" alt="avatar" style="height:150px;width:150px" class="responsive-img">
               </label>
               <form enctype="multipart/form-data" method="post" action="{{ route('bidder.profile.avatar',['id' => Auth::user()->id]) }}"> 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                <input type="hidden" name="_method" value="PATCH">
                <input type="file" name="image_avatar" id="image_avatar" style="display:none" onchange="previewImage(event)">
                <button id="btnUpload" class="btnUpload-hide waves-effect waves-light btn">Submit</button>
               </form>   
             </div>
                   <p style="padding:10px"><strong>Name</strong><br>{{ ucfirst(Auth::user()->firstname) }} {{ ucfirst(Auth::user()->lastname) }}</p>
                   <p style="padding:10px"><strong>Email</strong><br>{{ Auth::user()->email }}</p>
                   <p style="padding:10px"><strong>Contact No.</strong><br>{{ Auth::user()->mobile_no }}</p>
                   <p style="padding:10px"><strong>Address</strong><br>{{ Auth::user()->street_no }}, {{ Auth::user()->city }}</p>
                   <p style="padding:10px"><strong>Zip Code</strong><br>{{ Auth::user()->zip_code }}</p>
                   
                </div>
               
            
  </div>
@endsection
@push('scripts')
<script>
    $(".button-collapse").sideNav();
</script>
<script>
    var previewImage = function(event){
        var image = document.getElementById('imgAvatar');
        image.src = URL.createObjectURL(event.target.files[0]);
        $('#btnUpload').removeClass('btnUpload-hide');
    }
</script>

@endpush