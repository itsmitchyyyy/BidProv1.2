@extends('layouts.adminlayout')
@section('content')
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
                 <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Data Export</h3>
                            <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                            <div class="table-responsive">
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>USER ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Created At</th>
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