@extends('layouts.loginapp')
@section('content')
<section id="wrapper" class="login-register">
        <div class="login-box" style="margin-top:3%">
            <div class="white-box">
                <form class="form-horizontal" method="POST" id="loginform" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    
                    <h3 class="box-title m-b-20">Sign Up</h3>
                    <div class="floating-labels">
                  <div class="form-group{{ $errors->has('firstname') ? ' has-error' : ''}} ">
                    <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" class="form-control" required>
                    <span class="highlight"></span><span class="bar"></span>
                    <label for="firstname">First Name</label>
                    @if($errors->has('firstname'))
                            <p class="help-block">{{ $errors->first('firstname') }}</p>
                        @endif
                  </div>
                  </div>
                  <div class="floating-labels">
                  <div class="form-group{{ $errors->has('lastname') ? ' has-error' : ''}} ">
                    <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" class="form-control" required>
                    <span class="highlight"></span><span class="bar"></span>
                    <label for="firstname">Last Name</label>
                    @if($errors->has('lastname'))
                            <p class="help-block">{{ $errors->first('lastname') }}</p>
                        @endif
                  </div>
                  </div>
                  <div class="floating-labels">
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}} ">
                    <input type="text" name="email" id="email"  class="form-control" required>
                    <span class="highlight"></span><span class="bar"></span>
                    <label for="email">Email</label>
                    @if($errors->has('email'))
                            <p class="help-block">{{ $errors->first('email') }}</p>
                        @endif
                  </div>
                  </div>
                  <div class="floating-labels">
                  <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}} ">
                    <input type="text" name="username" id="username"  class="form-control" required>
                    <span class="highlight"></span><span class="bar"></span>
                    <label for="username">Username</label>
                    @if($errors->has('username'))
                            <p class="help-block">{{ $errors->first('username') }}</p>
                        @endif
                  </div>
                  </div>
                  <div class="floating-labels">
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}} ">
                    <input type="password" name="password" id="password"  class="form-control" required>
                    <span class="highlight"></span><span class="bar"></span>
                    <label for="password">Password</label>
                    @if($errors->has('password'))
                            <p class="help-block">{{ $errors->first('password') }}</p>
                        @endif
                  </div>
                  </div>
                  <div class="floating-labels">
                  <div class="form-group ">
                    <input type="password" name="password_confirmation" id="confirm" class="form-control" required>
                    <span class="highlight"></span><span class="bar"></span>
                    <label for="confirm">Confirm Password</label>
                  </div>
                  </div>
                <div class="form-group text-center{{ $errors->has('type') ? ' has-error' : ''}}">
                          <small class="{{ $errors->has('type') ? ' text-danger' : ''}}">Select Type</small>
                    <div class="text-center">
                        <label class="radio-inline radio-primary">
                            <input type="radio" name="type" id="" value="bidder"><span>Bidder</span>
                        </label>
                        <label class="radio-inline radio-primary">
                            <input type="radio" name="type" id="" value="seeker"><span>Seeker</span>
                        </label>
                        @if($errors->has('type'))
                            <p class="help-block">{{ $errors->first('type' )}}</p>
                        @endif
                    </div>
                </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" style="background-color:#ee4b28;border:2px solid #ee4b28">Sign Up</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Already have an account? <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Sign In</b></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @endsection
    @section('scripts')
    <script src="{{ asset('js/bootstrap/dist/js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/bootstrap-extension/js/bootstrap-extension.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
    
    @endsection