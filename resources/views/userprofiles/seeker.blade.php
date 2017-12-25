@extends('layouts.seekerapp')
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
        <label for="upload">
            <img src="" id="previewImage"  alt="profile picture" class="img wew" data-toggle="tooltip" title="Select Image">
            </label>
            <input type="file" name="upload" id="upload" style="display:none" onchange="loadImage(event)">
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn wew btn-secondary" data-dismiss="modal">Close</button>
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
                                        <a href="javascript:void(0)" id="newDP" data-toggle="tooltip" title="Update profile picture"><img src="/uploads/blank.png" id="imageSrc" class="thumb-lg img-circle" alt="img"></a>
                                    @else
                                        <a href="javascript:void(0)" id="newDP" data-toggle="tooltip" title="Update profile picture"><img src="{{$data->avatar}}" id="imageSrc" class="thumb-lg img-circle" alt="img"></a>
                                    @endif
                                        <!--<h6><a href="#" id="newDP" class="text-white" data-toggle="tooltip" title="Set new profile picture">Edit Profile Picture</a></h6>-->
                                        <h4 class="text-white">{{$data->name}}</h4>
                                        <h5 class="text-white">{{$data->email}}</h5> </div>
                                </div>
                            </div>
                           <div class="user-btm-box">
                                <!--<div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-purple"><i class="ti-facebook"></i></p>
                                    <h1>258</h1> </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-blue"><i class="ti-twitter"></i></p>
                                    <h1>125</h1> </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-danger"><i class="ti-dribbble"></i></p>
                                    <h1>556</h1> </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <ul class="nav customtab nav-tabs" id="tabMenu" role="tablist">
                                <li role="presentation" class="nav-item"><a href="#home" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa fa-home"></i></span><span class="hidden-xs"> Activity</span></a></li>
                                <li role="presentation" class="nav-item"><a href="#profile" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span></a></li>
                               <!-- <li role="presentation" class="nav-item"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-envelope-o"></i></span> <span class="hidden-xs">Message</span></a></li>-->
                               <li role="presentation" class="nav-item"><a href="#password" class="nav-link" aria-controls="password" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-key"></i></span> <span class="hidden-xs">Password</span></a></li>
                                <li role="presentation" class="nav-item"><a href="#settings" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Setting</span></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home">
                                    <div class="steamline">
                                         <!--  <div class="sl-item">
                                            <div class="sl-left"> <img src="/img/users/genu.jpg" alt="user" class="img-circle" /> </div>
                                            <div class="sl-right">
                                                <div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                    <p>assign a new task <a href="#"> Design weblayout</a></p>
                                                    <div class="m-t-20 row"><img src="/img/img1.jpg" alt="user" class="col-md-3 col-xs-12" /> <img src="/img/img2.jpg" alt="user" class="col-md-3 col-xs-12" /> <img src="/img/img3.jpg" alt="user" class="col-md-3 col-xs-12" /></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                   <div class="sl-item">
                                            <div class="sl-left"> 
                                                <img src="/img/users/sonu.jpg" alt="user" class="img-circle" />
                                            </div>
                                            <div class="sl-right">
                                                <div class="m-l-40"> <a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                    <div class="m-t-20 row">
                                                        <div class="col-md-2 col-xs-12">
                                                            <img src="/img/img1.jpg" alt="user" class="thumb-lg" />
                                                        </div>
                                                        <div class="col-md-9 col-xs-12">
                                                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa</p> <a href="#" class="btn btn-success"> Design weblayout</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="sl-item">
                                            <div class="sl-left"> <img src="/img/users/ritesh.jpg" alt="user" class="img-circle" /> </div>
                                            <div class="sl-right">
                                                <div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                    <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
                                                </div>
                                            </div>
                                        </div>-->
                                        
                                        <div class="sl-item">
                                            <div class="sl-left"> <img src="/img/users/govinda.jpg" alt="user" class="img-circle" /> </div>
                                            <div class="sl-right">
                                                <div class="m-l-40"><a href="#" class="text-info">{{ $data->name }}</a> <span class="sl-date">5 minutes ago</span>
                                                    <p>assign a new task <a href="#"> Design weblayout</a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                            <br>
                                            <p class="text-muted">{{ $data->name }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                            <br>
                                            <p class="text-muted">{{ $data->contact }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                            <br>
                                            <p class="text-muted">{{ $data->email }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                            <br>
                                            <p class="text-muted">{{ $data->address }}</p>
                                        </div>
                                    </div>
                                    <!--<hr>
                                    <p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries </p>
                                    <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>-->
                                    <h4 class="font-bold m-t-30">Skill Set</h4>
                                    <hr>
                                    <form action="" class="form-horizontal form-material">
                                    <div id="addInput" class="form-group">
                                    <p>
                                    <input type="text" id="pNew" name="pNew" placeholder="New skill" class="form-control form-control-line">
                                     <a href="#" id="addNew">Add more</a>
                                    </p>
                                    </div>
                                    </form>
                                    <h5>Wordpress <span class="pull-right">80%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>
                                    </div>
                                    <h5>HTML 5 <span class="pull-right">90%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">50% Complete</span> </div>
                                    </div>
                                    <h5>jQuery <span class="pull-right">50%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span> </div>
                                    </div>
                                    <h5>Photoshop <span class="pull-right">70%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> <span class="sr-only">50% Complete</span> </div>
                                    </div>
                                </div>
                               <!-- <div class="tab-pane" id="messages">
                                    <div class="steamline">
                                        <div class="sl-item">
                                            <div class="sl-left"> <img src="/img/users/genu.jpg" alt="user" class="img-circle" /> </div>
                                            <div class="sl-right">
                                                <div class="m-l-40"> <a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                    <div class="m-t-20 row">
                                                        <div class="col-md-2 col-xs-12"><img src="/img/img1.jpg" alt="user" class="thumb-lg" /></div>
                                                        <div class="col-md-9 col-xs-12">
                                                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa</p> <a href="#" class="btn btn-success"> Design weblayout</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="sl-item">
                                            <div class="sl-left"> <img src="/img/users/sonu.jpg" alt="user" class="img-circle" /> </div>
                                            <div class="sl-right">
                                                <div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                    <p>assign a new task <a href="#"> Design weblayout</a></p>
                                                    <div class="m-t-20 row"><img src="/img/img1.jpg" alt="user" class="col-md-3 col-xs-12" /> <img src="/img/img2.jpg" alt="user" class="col-md-3 col-xs-12" /> <img src="/img/img3.jpg" alt="user" class="col-md-3 col-xs-12" /></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="sl-item">
                                            <div class="sl-left"> <img src="/img/users/ritesh.jpg" alt="user" class="img-circle" /> </div>
                                            <div class="sl-right">
                                                <div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                    <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="sl-item">
                                            <div class="sl-left"> <img src="/img/users/govinda.jpg" alt="user" class="img-circle" /> </div>
                                            <div class="sl-right">
                                                <div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                    <p>assign a new task <a href="#"> Design weblayout</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
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
                                                <button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border:1px solid #ee4b28">Update Password</button>
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
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                                            <label class="col-md-12">Name</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Name" name="name" value="{{ $data->name }}" class="form-control form-control-line"> </div>
                                                @if($errors->has('name'))
                                                    <p class="help-block">{{ $errors->first('name') }}</p>
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
                                        <!--<div class="form-group">
                                            <label class="col-md-12">Password</label>
                                            <div class="col-md-12">
                                                <input type="password" value="password" class="form-control form-control-line"> </div>
                                        </div>-->
                                        <div class="form-group{{ $errors->has('contact') ? ' has-error' : ''}}">
                                            <label class="col-md-12">Contact No</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Contact No" name="contact" value="{{ $data->contact }}"  class="form-control form-control-line"> </div>
                                                @if($errors->has('contact'))
                                                    <p class="help-block">{{ $errors->first('contact') }}</p>
                                                @endif
                                        </div>
                                       <!-- <div class="form-group">
                                            <label class="col-md-12">Message</label>
                                            <div class="col-md-12">
                                                <textarea rows="5" class="form-control form-control-line"></textarea>
                                            </div>
                                        </div>-->
                                        <div class="form-group{{ $errors->has('address') ? ' has-error' : ''}}">
                                            <label class="col-sm-12">Address</label>
                                            <div class="col-sm-12">
                                            <input type="text" name="address" id="address" name="address" placeholder="Address" value="{{ $data->address }}" class="form-control form-control-line">
                                               <!-- <select class="form-control form-control-line">
                                                    <option>London</option>
                                                    <option>India</option>
                                                    <option>Usa</option>
                                                    <option>Canada</option>
                                                    <option>Thailand</option>
                                                </select>-->
                                                @if($errors->has('address'))
                                                    <p class="help-block">{{ $errors->first('address') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-primary wew" style="background-color:#ee4b28;border:1px solid #ee4b28">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .right-sidebar -->
                <!--<div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul>
                                <li><b>Layout Options</b></li>
                                <li>
                                    <div class="checkbox checkbox-info">
                                        <input id="checkbox1" type="checkbox" class="fxhdr">
                                        <label for="checkbox1"> Fix Header </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox checkbox-warning">
                                        <input id="checkbox2" type="checkbox" checked="" class="fxsdr">
                                        <label for="checkbox2"> Fix Sidebar </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox4" type="checkbox" class="open-close">
                                        <label for="checkbox4"> Toggle Sidebar </label>
                                    </div>
                                </li>
                            </ul>
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" theme="blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
                                <li><b>With Dark sidebar</b></li>
                                <br/>
                                <li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="/img/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="/img/users/genu.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="/img/users/ritesh.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="/img/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="/img/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="/img/users/hritik.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="/img/users/john.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="/img/users/pawandeep.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>-->
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy;  brought to you by BidPro </footer>
        </div>
        <!-- /#page-wrapper -->
@endsection