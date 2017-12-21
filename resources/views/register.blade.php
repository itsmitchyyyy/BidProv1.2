@extends('layouts.loginapp')
@section('content')
<section id="wrapper" class="login-register">
        <div class="login-box" style="margin-top:3%">
            <div class="white-box">
                <form class="form-horizontal" method="POST" id="loginform" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    
                    <h3 class="box-title m-b-20">Sign Up</h3>
                    <div class="floating-labels">
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}} ">
                    <input type="text" name="name" id="name" class="form-control" required>
                    <span class="highlight"></span><span class="bar"></span>
                    <label for="name">Name</label>
                    @if($errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif
                  </div>
                  </div>
                  <div class="floating-labels">
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}} ">
                    <input type="text" name="email" id="email" class="form-control" required>
                    <span class="highlight"></span><span class="bar"></span>
                    <label for="email">Email</label>
                    @if($errors->has('email'))
                            <p class="help-block">{{ $errors->first('email') }}</p>
                        @endif
                  </div>
                  </div>
                  <div class="floating-labels">
                  <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}} ">
                    <input type="text" name="username" id="username" class="form-control" required>
                    <span class="highlight"></span><span class="bar"></span>
                    <label for="username">Username</label>
                    @if($errors->has('username'))
                            <p class="help-block">{{ $errors->first('username') }}</p>
                        @endif
                  </div>
                  </div>
                  <div class="floating-labels">
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}} ">
                    <input type="password" name="password" id="password" class="form-control" required>
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
                   <!-- <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}} ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="name" required="" placeholder="Full Name">
                        </div>
                        @if($errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}} ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="email" required="" placeholder="Email">
                        </div>
                        @if($errors->has('email'))
                        <p class="help-block">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}} ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="username" required="" placeholder="Username">
                        </div>
                        @if($errors->has('username'))
                        <p class="help-block">{{ $errors->first('username') }}</p>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}} ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Password">
                        </div>
                        @if($errors->has('password'))
                            <p class="help-block">{{ $errors->first('password' )}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password_confirmation" required="" placeholder="Confirm Password">
                        </div>
                    </div>-->
                  
                   <!-- <div class=" text-center form-group{{ $errors->has('type') ? ' has-error' : ''}} ">
                        <div class="form-check form-check-inline">
                            <label  class="form-check-label">
                                <input class="form-check-input" require type="radio" name="type" id="" value="biddeR"> Bidder
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label  class="form-check-label">
                                <input class="form-check-input" require type="radio" name="type" id="" value="seeker"> Seeker
                            </label>
                        </div>
                        @if($errors->has('type'))
                            <p class="help-block">{{ $errors->first('type' )}}</p>
                        @endif
                    </div>-->
                    <!--
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
                            </div>
                        </div>
                    </div>
                -->
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