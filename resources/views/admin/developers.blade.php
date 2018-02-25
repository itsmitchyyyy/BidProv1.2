@extends('layouts.adminlayout')
@push('css')
    <style>
        .active{
            color:#ff8400;
        }
        .not-active{
            color:grey;
        }
    </style>
@endpush
@section('content')
@inject('controller','App\Http\Controllers\AdminController')
 <!-- Page Content -->
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Bidders</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="#">Bidders</a></li>
                            <li class="active">List of Bidders</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                  <!-- /.row -->
       <div class="row">
           <div class="col-md-12 col-lg-12 col-sm-12">
               <div class="white-box">
                   <div class="row row-in">
                       <div class="col-lg-3 col-sm-6 row-in-br">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="mi-account-box"></i>
                                   <h5 class="text-muted vb">TOTAL BIDDERS</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3 class="counter text-right m-t-15 text-danger">{{ $controller->userBidder()  }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ $controller->userBidder()  }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->userBidder()  }}%"> </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                                   <h5 class="text-muted vb">TOTAL ACTIVE BIDDERS</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3 class="counter text-right m-t-15 text-megna">{{ $controller->activeBidder() }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="{{ $controller->activeBidder() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->activeBidder() }}%">  </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3 col-sm-6 row-in-br">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                                   <h5 class="text-muted vb">TOTAL BANNED BIDDERS</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3 class="counter text-right m-t-15 text-primary">{{ $controller->bannedBidder() }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ $controller->bannedBidder() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->bannedBidder() }}%"> </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <!-- <div class="col-lg-3 col-sm-6  b-0">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe016;"></i>
                                   <h5 class="text-muted vb">Reports</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3 class="counter text-right m-t-15 text-success">{{ $controller->userSeeker() }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $controller->userSeeker() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->userSeeker() }}%">  </div>
                                   </div>
                               </div>
                           </div>
                       </div> -->
                   </div>
               </div>
           </div>
       </div>
       <!--row -->
                 <div class="col-sm-12">
                        <div class="white-box">
                            <!-- <h3 class="box-title m-b-0">Data Export</h3> -->
                            <ol class="breadcrumb">
                                <li ><a href="#" id="usersAll" class="active">All Users</a></li>
                                <li ><a href="#" id="usersBanned" class="not-active">Banned Users</a></li>
                            </ol>
                            <!-- ALL USERS -->
                            <div class="table-responsive" id="allUser">
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>USER ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Created At</th>
                                            <th>Total Reports</th>
                                            <th>Status</th>
                                            <th class="uniqye">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                         <th>USER ID</th>
                                         <th>Name</th>
                                         <th>Email</th>
                                         <th>Contact</th>
                                          <th>Created At</th>
                                          <th>TOtal Reports</th>
                                          <th>Status</th>
                                          <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                   @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ ucfirst($user->firstname) }} {{ ucfirst($user->lastname) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mobile_no }}</td>
                                            <td>{{ Carbon\Carbon::parse($user->created_at)->toDayDateTimeString() }}</td>
                                            <td>{{ $controller->bidderReports($user->id) }}</td>
                                            <td>
                                            @if($user->status == 1)
                                                Active
                                            @else
                                                Disabled
                                            @endif
                                            </td>
                                            <td class="text-nowrap">
                                                <!-- <a href="#" data-toggle="tooltip" title="Edit"> <i style="font-size:16px" class="fa fa-pencil text-inverse m-r-10"></i> </a> -->
                                                @if($user->status == 1)
                                                <a href="#" data-tooltip="true" title="Close" onclick="deactivate({{ $user->id }})"> <i style="font-size:24px" class="fa fa-ban text-danger m-r-10"></i> </a>
                                                @else
                                                <a href="#" data-tooltip="true" title="Close" onclick="activate({{ $user->id }})"> <i style="font-size:24px" class="fa fa-check text-blue m-r-10"></i> </a>
                                                @endif
                                                <a href="#" onclick="viewProfile({{ $user->id }})" title="View"> <i style="font-size:24px"  class="fa fa-eye text-success m-r-10"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- END OF USERS -->
                              <!-- BANNED USERS -->
                              <div class="table-responsive" id="bannedUsers">
                                <table id="usersTable" class="display nowrap " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                        <th>USER ID</th>
                                         <th>Name</th>
                                         <th>Email</th>
                                         <th>Contact</th>
                                          <th>Created At</th>
                                          <th>Total Reports</th>
                                          <th>Status</th>
                                          <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>USER ID</th>
                                         <th>Name</th>
                                         <th>Email</th>
                                         <th>Contact</th>
                                          <th>Created At</th>
                                          <th>Total Reports</th>
                                          <th>Status</th>
                                          <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($controller->getBannedBidders() as $bidder)
                                        <tr>
                                            <td>{{ $bidder->id }}</td>
                                            <td>{{ ucfirst($bidder->firstname) }} {{ ucfirst($bidder->lastname) }}</td>
                                            <td>{{ $bidder->email }}</td>
                                            <td>{{ $bidder->mobile_no }}</td>
                                            <td>{{ Carbon\Carbon::parse($bidder->created_at)->toDayDateTimeString() }}</td>
                                            <td>{{ $controller->seekerReports($bidder->id) }}</td>
                                            <td>
                                            @if($bidder->status == 1)
                                                Active
                                            @else
                                                Disabled
                                            @endif
                                            </td>
                                            <td class="text-nowrap">
                                                <!-- <a href="#" data-toggle="tooltip" title="Edit"> <i style="font-size:16px" class="fa fa-pencil text-inverse m-r-10"></i> </a> -->
                                                @if($bidder->status == 1)
                                                <a href="#" data-tooltip="true" title="Close" onclick="deactivate({{ $bidder->id }})"> <i style="font-size:24px" class="fa fa-ban text-danger m-r-10"></i> </a>
                                                @else
                                                <a href="#" data-tooltip="true" title="Close" onclick="activate({{ $bidder->id }})"> <i style="font-size:24px" class="fa fa-check text-blue m-r-10"></i> </a>
                                                @endif
                                                <a href="#" onclick="viewProfile({{ $bidder->id }})" title="View"> <i style="font-size:24px"  class="fa fa-eye text-success m-r-10"></i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- END OF BANNED USERS -->
                        </div>
                    </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; bidpro brought to you by CodeX </footer>
        </div>
        <!-- /#page-wrapper -->



    <!-- MODAL -->
        <div class="modal" style="mt-5" tabindex="-1" id="viewProfile">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal"><span>&times;</span></button>
                        <h3>User Profile</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fullname" class="col-2 col-form-label">Fullname</label>
                            <div class="col-10">
                                <span id="fullname"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-2 col-form-label">Email</label>
                            <div class="col-10">
                                <span id="email"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="col-2 col-form-label">Mobile</label>
                            <div class="col-10">
                                <span id="mobile"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="landline" class="col-2 col-form-label">Landline</label>
                            <div class="col-10">
                                <span id="landline"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="street" class="col-2 col-form-label">Street</label>
                            <div class="col-10">
                                <span id="street"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-2 col-form-label">City</label>
                            <div class="col-10">
                                <span id="city"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary wew" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- END MODAL -->
@endsection
@push('scripts')
<script>
  $(function(){
      $('#bannedUsers').hide();
      $('#usersBanned').click(function(){
          $('#usersBanned').removeClass('not-active').addClass('active');
          $('#usersAll').removeClass('active').addClass('not-active');
          $('#bannedUsers').show();
          $('#allUser').hide();
      });
      $('#usersAll').click(function(){
          $('#usersAll').removeClass('not-active').addClass('active');
          $('#usersBanned').removeClass('active').addClass('not-active');
        $('#bannedUsers').hide();
          $('#allUser').show();
      });
  });
</script>
<script>
    $(function(){
        $("[data-tooltip='true']").tooltip();
    });
</script>
<script>
    function viewProfile(user_id){
        // $('#viewProfile').modal('show');
        $.ajax({
            type:"get",
            url:"{{ route('users.profile') }}",
            data:{
                'user_id':user_id
            },
            dataType: "json",
            cache:false,
            success:function(response){
                $('#fullname').text(response.firstname + ' ' +response.lastname);
                $('#email').text(response.email);
                $('#mobile').text(response.mobile_no);
                $('#landline').text(response.landline);
                $('#street').text(response.street_no);
                $('#city').text(response.city);
                $('#viewProfile').modal('show');
            }
        });
    }
</script>
<script>
    function activate(user_id){
            swal({
                title: "Activate",
                text: "Are you sure you want to activate this user?",
                buttons:true,
                icon: "warning"
            }).then(function(value){
                if(value){
                    $.ajax({
                    type: "post",
                    url: "{{ route('user.activate') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'user_id': user_id
                    },
                    cache:false,
                    success:function(response){
                       swal({
                           title: "Success",
                           text: "This user has been activated successfully",
                           buttons:false,
                           icon:"success"
                       });
                        setTimeout(function(){
                            location.reload();
                        },1000);
                    }
                });
                }else{
                    swal("Error","Error when activating this user","error");
                }
            });
        }
</script>
   <script>
        function deactivate(user_id){
            swal({
                title: "Deactivate",
                text: "Are you sure you want to deactivate this user?",
                buttons:true,
                icon: "warning"
            }).then(function(value){
                if(value){
                    $.ajax({
                    type: "post",
                    url: "{{ route('user.deactivate') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'user_id': user_id
                    },
                    cache:false,
                    success:function(response){
                       swal({
                           title: "Success",
                           text: "This user has been deactivated successfully",
                           buttons:false,
                           icon:"success"
                       });
                        setTimeout(function(){
                            location.reload();
                        },1000);
                    }
                });
                }else{
                    swal("Error","Error when deactivating this user","error");
                }
            });
        }
   </script>
@endpush