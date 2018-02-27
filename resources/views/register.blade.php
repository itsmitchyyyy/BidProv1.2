@extends('layouts.loginapp')
@section('content')
<section id="wrapper" class="login-register" style="overflow:auto">
        <div class="login-box" style="margin-top:3%;width:30%">
            <div class="white-box">
            <div class="text-center">
                 <a href="{{ route('landing') }}"><img src="/img/bidprologo.png" alt="logo" style="height:150;width:150px"></a>
                </div>
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
                <div class="form-group">
                        <div class="col-xs-12 text-center">
                           <input type="checkbox" name="terms" id="terms" class="m-r-5 p-5"><a href="#" data-toggle="modal" data-target="#tandc">Terms and conditions</a> 
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <p id="message"></p>
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" id="btnSubmit" style="background-color:#ee4b28;border:2px solid #ee4b28">Sign Up</button>
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
    <div class="modal fade" id="tandc">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                    <h3>Terms and Conditions</h3>
                </div>
                <div class="modal-body">
                    <p >
                  <strong> The proposed system has the following rules and policies:</strong> 
</p>


<p class="text-justify">
    By accessing the Website, you agree to the following terms with Bidpro.<br>
    We may amend this User Agreement and any linked information from time to time by posting amended terms on the Website, without notice to you. 
    </p>
    <p>
Bidpro is a venue where Users post and bid Seller Services and projects. Bidders and Seekers must register for an Account in order to bid or post Seller Services and/or projects. Bidpro enables Users to work together online to complete and pay for Projects, post and bid projects and to use the services that we provide. We are not a party to any contractual agreements between Buyer and Seller in the online venue, we merely facilitate connections between the parties. 
We may, from time to time, and without notice, change or add to the system or the information, products or services described in it. However, we do not undertake to keep the system updated. We are not liable to you or anyone else if any error occurs in the information on the system or if that information is not current. 
</p>
<strong>Rules and Policies</strong>
<br><br>
•	Bidder can bid only once for every project created by SDPSeeker.<br>
•	Seeker must submit complete details of the project.<br>
•	Bidder should submit a proper proposal to seeker/ clients.<br>
•	Every project is available only 6 days after posted it to system.<br>
•	Seeker has the right, suggest or add comment about the system progress.<br>
•	User will use one and only account e.g gmail address.<br>
•	Paypal Account are existing in Seeker and Bidder accounts for transaction.<br>
•	Any outdoor presentations of the project <br>
•	Our system doesn’t support Auto-bidding.<br>
•	SDP Bidders are freelancers. Actual corporate IT organizations will not be allowed to create accounts.<br>
•	The system will not be held responsible if the users will not commit to agreement of both parties (outside the system).<br>
•	User must agree the terms and conditions.<br>
•	Bidder will proper schedule for presentation of the system.<br>
<!-- •	If the project closed or done and not completely presented by the bidder , admin automatically refund thru admin system. <br> -->
•   The project will be posted for a span of 6 days, if there will be no bidder, the project will be deleted

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('scripts')
    <script src="{{ asset('js/bootstrap/dist/js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/bootstrap-extension/js/bootstrap-extension.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
    <script>    
        $(function(){
            $('#btnSubmit').prop('disabled',true);
                $('#message').text('Accept terms and conditions before signing up');
            $('#terms').change(function(){
                if($('#terms').is(':checked')){
                $('#btnSubmit').prop('disabled',false);
                $('#message').text('');
            }else{
                $('#btnSubmit').prop('disabled',true);
                $('#message').text('Accept terms and conditions before signing up');
            }
            });
        });
    </script>
    @endsection