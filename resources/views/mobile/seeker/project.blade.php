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
                    <ul class="collapsible" data-collapsible="accordion">
                        @if($projects->isEmpty())
                        <h4 style="text-align:center">NO PROJECTS</h4>
                        @else
                        @foreach($projects as $project)
                            <li>
                              <div class="collapsible-header">
                                <i class="material-icons">description</i>
                                {{ $project->title }}
                                <span class="new badge red" data-badge-caption="{{ ucfirst($project->status) }}"></span></div>
                              <div class="collapsible-body">
                                  <p><strong>Details:</strong>
                                   <br>{{ $project->details }}<br>
                                </p>
                            </div>
                            </li>
                        @endforeach
                        @endif
                          </ul>   
                 
                </div>
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