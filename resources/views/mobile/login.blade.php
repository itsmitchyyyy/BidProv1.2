@extends('layouts.mobileapp')
@push('css')
<style>
     body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    main {
      flex: 1 0 auto;
    }

    body {
      background: #fff;
    }

    .input-field input[type=date]:focus + label,
    .input-field input[type=text]:focus + label,
    .input-field input[type=email]:focus + label,
    .input-field input[type=password]:focus + label {
      color: #ff7043;
    }

    .input-field input[type=date]:focus,
    .input-field input[type=text]:focus,
    .input-field input[type=email]:focus,
    .input-field input[type=password]:focus {
      border-bottom: 2px solid #ff7043;
      box-shadow: none;
    }
    .background-image{
        background:url('uploads/mobile-logo.jpg'); 
        background-size:cover;
        background-repeat:no-repeat;
    }
</style>
@endpush
@section('content')
  <main  style="background:#ccc">
    <center>
     
      <div class="section"></div>

      <!-- <h5 class="indigo-text">Please, login into your account</h5> -->
      <div class="section"></div>

      <div class="container">
        <div class="z-depth-1 grey lighten-4 row background-image" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form class="col s12" method="post" action="{{ route('mobile.login') }}">
            {{ csrf_field() }}
            
          <img class="responsive-img" style="width: 250px;" src="img/bidprologo.png" />
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>
            @if($errors->has('error'))
            <div>
            <p style="color:red;text-align:center;font-weight:bold">{{ $errors->first('error') }}</p>
            </div>
            @endif
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='text' name='username' id='username' />
                <label for='email'>Enter your username</label>
                @if($errors->has('username'))
                <div>
            <p style="color:red;text-align:center;font-weight:bold">{{ $errors->first('username') }}</p>
            </div>
            @endif
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12 error'>
                <input class='validate' type='password' name='password' id='password' />
                <label for='password'>Enter your password</label>
                @if($errors->has('password'))
                <div>
              <p style="color:red;text-align:center;font-weight:bold">{{ $errors->first('password') }}</p>
            </div>
            @endif
              </div>
              <label style='float: right;'>
								<!-- <a class='pink-text' href='#!'><b>Forgot Password?</b></a> -->
							</label>
            </div>
            <br />
            <center>
              <div class='row'>
                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect deep-orange'>Login</button>
              </div>
            </center>
          </form>
        </div>
      </div>
      <!-- <a href="#!">Create account</a> -->
    </center>

    <div class="section"></div>
    <div class="section"></div>
  </main>
@endsection