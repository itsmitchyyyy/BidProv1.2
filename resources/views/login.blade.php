@extends('layouts.loginapp')
@section('content')
<!-- Preloader -->
<!--<div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
-->
    <section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">
                <form class="floating-labels" method="POST" id="loginform" action="{{ route('login') }}">
                    {{ csrf_field() }}    
                <h3 class="box-title m-b-20">Sign In</h3>
                   
                   <!-- <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="username" required="" placeholder="Username">
                        </div>
                        @if($errors->has('username'))
                        <p class="help-block">{{ $errors->first('username') }}</p>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Password">
                        </div>
                        @if($errors->has('password'))
                        <p class="help-block">{{ $errors->first('password') }}</p>
                        @endif
                    </div>-->
                        <div class="form-group{{ $errors->has('error') ? ' has-error' : ''}}">
                            @if($errors->has('error'))
                                <b><p class="help-block text-center text-danger">{{ $errors->first('error') }}</p></b>
                            @endif
                        </div>

                    <div class="form-group m-b-20 m-t-10{{ $errors->has('username') ? ' has-error' : ''}}">
                        <input type="text" name="username" id="username" class="form-control" required>
                        <span class="highlight"></span><span class="bar"></span>
                        <label for="username">Username</label>
                        @if($errors->has('username'))
                        <p class="help-block">{{ $errors->first('username') }}</p>
                        @endif
                    </div>
                 
                    <div class="form-group m-b-15 m-t-15{{ $errors->has('password') ? ' has-error' : ''}}">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <span class="highlight"></span><span class="bar"></span>
                        <label for="password">Password</label>
                        @if($errors->has('password'))
                        <p class="help-block">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    
                    <div class="form-group m-b-15 m-t-15">
                        <div class="col-md-12">
                          <!--  <div class="checkbox checkbox-primary pull-left p-t-0" style>
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> Remember me </label>
                            </div>-->
                            
                            <a href="{{ route('password.email') }}" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>
                             </div>
                    </div>
                    
                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" style="background-color:#ee4b28;border:2px solid #ee4b28" type="submit">Log In</button>
                        </div>
                    </div>
                    </form>
                    <!--
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                            <div class="social">
                                <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                            </div>
                        </div>
                    </div>-->
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                        </div>
                    </div>
                
                
                
                </form>
                
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