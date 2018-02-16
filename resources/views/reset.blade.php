@extends('layouts.loginapp')
@section('content')
<section id="wrapper" class="login-register">
        <div class="login-box" >
            <div class="white-box">
                <form class="form-horizontal form-material"  method="POST" id="loginform" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <h3 class="box-title m-b-20">Reset Password</h3>
                    <input type="hidden" name="_token" value="{{ $token }}">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="email" name="email" id="email" class="form-control" value="{{ $email or old('email') }}" placeholder="Email Address" required autofocus>
                        </div>
                        @if($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        @if($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                     
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-info waves-effect waves-light text-uppercase btn-lg btn-block" style="background-color:#ee4b28;border:2px solid #ee4b28">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @endsection