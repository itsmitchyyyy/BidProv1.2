@extends('layouts.mobilelayout')
@push('css')
    <style>
        html, body {height:100%;}
        body {margin:0;padding:0;}
    </style>
@endpush
@section('content')
<nav>
    <div class="nav-wrapper deep-orange">
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
      <ul id="slide-out" class="side-nav">
    <li>
        <div class="user-view">
      <div class="background">
        <img src="img/login-background.jpg">
      </div>
      <a href="#!user"><img class="circle" src="{{ Auth::user()->avatar }}"></a>
      <a href="#!name"><span class="black-text name">{{ ucfirst(Auth::user()->firstname) }} {{ ucfirst(Auth::user()->lastname) }}</span></a>
      <a href="#!email"><span class="black-text email">{{ Auth::user()->email }}</span></a>
    </div></li>
    <li><a href="#!"><i class="material-icons">account_circle</i>Profile</a></li>
    <li><a href="#!"><i class="material-icons">description</i>Project</a></li>
    <li><a href="#!"><i class="material-icons">power_settings_new</i>Logout</a></li>
  </ul>
      <div style="background:#ccc;position:relative;top:0;left:0;height:100%;width:100%;">
           <div style="border:1px solid rgba(0,0,0,0);display: block;height:100%">
               <div style="margin-top:50%;margin-left:auto;margin-right:auto;width:80%;padding:10px">
                  <div class="deep-orange" style="border:1px solid black;text-align:center;padding:15px">
                      <strong style="font-size:24px" >GET STARTED</strong>
                  </div>
               </div>
           </div>
            
  </div>
@endsection
@push('scripts')
<script>
    $(".button-collapse").sideNav();
</script>
@endpush