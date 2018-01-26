@extends('layouts.seekerapp')
@push('css')
<style>
.glyphicon-star:before {
    content: "\f005";  /* this is your text. You can also use UTF-8 character codes as I do here */
    font-family: FontAwesome;
}
.glyphicon-star-empty:before {
    content: "\f005";  /* this is your text. You can also use UTF-8 character codes as I do here */
    font-family: FontAwesome;
}
</style>
@endpush
@section('content')

<div class="modal fade" id="profileImage" tabindex="-1" role="dialog" aria-labelledby="profileImage" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" data-dismiss="modal" class="close"><span aria-hidden="true">x</span></button>
            <h4 class="modal-title" id="profileImageLabel">Set new profile picture</h4>
        </div>
        <div class="modal-body text-center">
        <div style="height:150px;width:200px;" class="ml-auto mr-auto">
        <label for="myUpload">
            <img src="" id="previewImage"  alt="profile picture" class="img wew" data-tooltip="true" title="Select Image">
            </label>
            <form method="POST" enctype="multipart/form-data" action="{{ route('avatar', ['id' => Auth::user()->id]) }}">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="file" name="avatar" id="myUpload" style="display:none"  onchange="loadImage(event)">
            
            @if($errors->has('avatar'))
                <p class="help-block">{{ $errors->first('avatar') }}</p>
            @endif
        </div>
        </div>
        <div class="modal-footer">
            <button type="button"  class="btn wew btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" disabled id="uploadBtn" class="btn wew btn-primary" style="background-color:#ee4b28">Update</button>
            </form>
        </div>
    </div>
</div>
</div>
  <!-- Page Content -->
            <div id="">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">My Profile</h4> </div>
                   
                </div>
                <!-- /.row -->
                <!-- .row -->

                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> 
                            <img width="100%" alt="user" src="/uploads/blank.png">
                            
                                <div class="overlay-box">
                                    <div class="user-content">
                                    @if($data->avatar == null)
                                        <a href="javascript:void(0)" id="newDP" data-tooltip="true" title="Update profile picture"><img src="/uploads/blank.png" id="imageSrc" class="thumb-lg img-circle" alt="img"></a>
                                    @else
                                        <a href="javascript:void(0)" id="newDP" data-tooltip="true" title="Update profile picture"><img src="/{{$data->avatar}}" id="imageSrc" class="thumb-lg img-circle" alt="img"></a>
                                    @endif
                                        <!--<h6><a href="#" id="newDP" class="text-white" data-toggle="tooltip" title="Set new profile picture">Edit Profile Picture</a></h6>-->
                                        <h4 class="text-white">{{$data->name}}</h4>
                                        <h5 class="text-white">{{$data->email}}</h5> 
                                        <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $data->averageRating }}" data-size="s" disabled="">
                                        </div>
                                </div>
                            </div>
                           <div class="user-btm-box">
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <ul class="nav customtab nav-tabs" id="tabMenu" role="tablist">
                                <!-- <li role="presentation" class="nav-item"><a href="#home" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa fa-home"></i></span><span class="hidden-xs"> Activity</span></a></li> -->
                                <li role="presentation" class="nav-item"><a href="#profile" class="nav-link active" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span></a></li>
                               <!-- <li role="presentation" class="nav-item"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-envelope-o"></i></span> <span class="hidden-xs">Message</span></a></li>-->
                               <li role="presentation" class="nav-item"><a href="#password" class="nav-link" aria-controls="password" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-key"></i></span> <span class="hidden-xs">Password</span></a></li>
                                <li role="presentation" class="nav-item"><a href="#settings" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Setting</span></a></li>
                            </ul>
                            <div class="tab-content">
                               
                                <div class="tab-pane active" id="profile">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                            <br>
                                            <p class="text-muted">{{ $data->firstname }} {{ $data->lastname  }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                            <br>
                                            <p class="text-muted">{{ $data->mobile_no }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Landline</strong>
                                            <br>
                                            <p class="text-muted">{{ $data->landline }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6"> <strong>Email</strong>
                                            <br>
                                            <p class="text-muted">{{ $data->email }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"><strong>Street No</strong>
                                           <br>
                                            <p class="text-muted">{{ $data->street_no }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"><strong>City</strong>
                                            <br>
                                            <p class="text-muted">{{ $data->city }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"><strong>Province</strong>
                                            <br>
                                            <p class="text-muted">{{ $data->province }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6"><strong>Zip Code</strong>
                                            <br>
                                            <p class="text-muted">{{ $data->zip_code }}</p>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="tab-pane" id="password">
                                    <form action="{{ route('profile', ['id' => Auth::user()->id]) }}" class="form-horizontal form-material" method="post">
                                        @if(session()->get('success'))
                                            <div class="alert alert-success alert-dismissable fade show">
                                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button>
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif
                                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : ''}}">
                                            <label class="col-md-12" for="current_password">Current Password</label>
                                            <div class="col-md-12">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="password" name="current_password" placeholder="Current Password" id="current_password" class="form-control form-control-line">
                                                @if($errors->has('current_password'))
                                                    <p class="help-block" style="color:red">{{ $errors->first('current_password') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
                                            <label class="col-md-12">New Password</label>
                                            <div class="col-md-12">
                                                <input type="password" name="password" id="password" placeholder="New Password" class="form-control form-control-line">
                                                @if($errors->has('password'))
                                                    <p class="help-block" style="color:red">{{ $errors->first('password') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ''}}">
                                            <label class="col-md-12">Confirm Password</label>
                                            <div class="col-md-12">
                                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="form-control form-control-line">
                                                @if($errors->has('password_confirmation'))
                                                    <p class="help-block" style="color:red">{{ $errors->first('password_confirmation') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" id="updatePassword" class="btn btn-primary wew" style="background-color:#ee4b28;border:1px solid #ee4b28">Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- SETTINGS TAB -->
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal form-material" method="post" action="{{ route('profile', ['id' => Auth::user()->id]) }}">
                                     
                                        @if(session()->get('success'))
                                            <div class="alert alert-success alert-dismissable fade show">
                                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button>
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif
                                        <input type="hidden" name="_method" value="PATCH">
                                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : ''}}">
                                            <label class="col-md-12">Firstname</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="First Name" name="firstname" value="{{ $data->firstname }}" class="form-control form-control-line"> </div>
                                                @if($errors->has('firstname'))
                                                    <p class="help-block">{{ $errors->first('firstname') }}</p>
                                                @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : ''}}">
                                            <label class="col-md-12">Lastname</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Last Name" name="lastname" value="{{ $data->lastname }}" class="form-control form-control-line"> </div>
                                                @if($errors->has('lastname'))
                                                    <p class="help-block">{{ $errors->first('lastname') }}</p>
                                                @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                                            <label for="example-email" class="col-md-12">Email</label>
                                            <div class="col-md-12">
                                                <input type="email" placeholder="Email" name="email" value="{{ $data->email }}" class="form-control -line"  id="example-email"> </div>
                                                @if($errors->has('name'))
                                                    <p class="help-block">{{ $errors->first('email') }}</p>
                                                @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : ''}}">
                                            <label class="col-md-12">Mobile No</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Mobile No" name="mobile_no" value="{{ $data->mobile_no }}"  class="form-control form-control-line"> </div>
                                                @if($errors->has('mobile_no'))
                                                    <p class="help-block">{{ $errors->first('mobile_no') }}</p>
                                                @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('landline') ? ' has-error' : ''}}">
                                            <label class="col-md-12">Landline No</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Landline No" name="landline" value="@if( $data->landline == null) 0(32)  @else {{ $data->landline }} @endif"  class="form-control form-control-line"> </div>
                                                @if($errors->has('landline'))
                                                    <p class="help-block">{{ $errors->first('landline') }}</p>
                                                @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('street_no') ? ' has-error' : ''}}">
                                            <label class="col-sm-12">Street No</label>
                                            <div class="col-sm-12">
                                            <input type="text" name="street_no" id="street_no" name="street_no" placeholder="Street No" value="{{ $data->street_no }}" class="form-control form-control-line">
                                                @if($errors->has('street_no'))
                                                    <p class="help-block">{{ $errors->first('street_no') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('city') ? ' has-error' : ''}}">
                                            <label class="col-sm-12">City</label>
                                            <div class="col-sm-12">
                                            <input type="text" name="city" id="city" name="city" placeholder="City" value="{{ $data->city }}" class="form-control form-control-line">
                                                @if($errors->has('city'))
                                                    <p class="help-block">{{ $errors->first('city') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('province') ? ' has-error' : ''}}">
                                            <label class="col-sm-12">Province</label>
                                            <div class="col-sm-12">
                                            <input type="text" name="province" id="province" name="province" placeholder="Province" value="{{ $data->province }}" class="form-control form-control-line">
                                                @if($errors->has('province'))
                                                    <p class="help-block">{{ $errors->first('province') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : ''}}">
                                            <label class="col-sm-12">Zip Code</label>
                                            <div class="col-sm-12">
                                            <input type="text" name="zip_code" id="zip_code" name="zip_code" placeholder="Zip Code" value="{{ $data->zip_code }}" class="form-control form-control-line">
                                                @if($errors->has('zip_code'))
                                                    <p class="help-block">{{ $errors->first('zip_code') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-primary wew" id="updateProfile"  style="background-color:#ee4b28;border:1px solid #ee4b28">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy;  brought to you by BidPro </footer>
        </div>
        <!-- /#page-wrapper -->
@endsection
@section('scripts')
<!-- <script src="{{ asset('js/landing-page/jquery/jquery.min.js') }}"></script> -->
<script src="{{ asset('js/star-rating.js') }}"></script>
<script>
    $('#input-id').rating();
</script>
<script>
        var loadImage = function(event){
            var image = document.getElementById('previewImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
   </script>
   <script>
   $('#myUpload').change(function(){
        if($(this).val()){
            $('#uploadBtn').attr('disabled',false);
        }else{
            $('#uploadBtn').attr('disabled', 'disabled');
        }
   });
   </script>
   <script>
    $(function(){
        var addDiv = $('#addInput');
        var i = $('#addInput p').length + 1;

        $('#addNew').on('click', function(){
            $('<p><input type="text" id="pNew" name="pNew[]" placeholder="New skill" class="form-control form-control-line"/><a href="#" id="remNew">Remove</a> </p>').appendTo(addDiv);
            i++;
            return false;
        });

        $('#addInput').on('click','#remNew', function(){
            if( i > 2){
                $(this).parents('p').remove();
                i--;
            }
            return false;
        });
    });
   </script>
   
   <script>
        $('#newDP').on('click', function(){
            $('#previewImage').attr('src', $('#imageSrc').attr('src'));
            $('#profileImage').modal('show');
        });
   </script>
    <script>
    @if($errors->has('avatar'))
        $('#profileImage').modal('show');
        $('#profileImage').data('bs.modal').handleUpdate();
    @endif
    $('#profileImage').on('hidden.bs.modal', function(){
        $(this).removeData();
        $('#uploadBtn').attr('disabled','disabled');
    });
    </script>
    <script>
        $(document).ready(function(){
            $('#updatePassword').attr('disabled',true);
            $('form :input').not('#updatePassword').bind('keyup', function(){
                if($(this).val().length != 0){
                    $('#updatePassword').attr('disabled', false);
                }else{
                    $('#updatePassword').attr('disabled', true);
                }
            });
        })
    </script>
    <script>
        $('form').each(function(){
            $(this).data('serialized', $(this).serialize())
        }).on('change input', function(){
            $(this).find('#updateProfile').prop('disabled', $(this).serialize() == $(this).data('serialized'));
        }).find('#updateProfile').prop('disabled',true);
    </script>
   <script>
     $(document).ready(function(){
         $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show');
     });
    </script>
@endsection