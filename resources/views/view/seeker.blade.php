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
.gap-right{
    margin-right: 10px;
}
</style>
@endpush
@section('content')
<!-- <div class="modal fade" id="reportModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                <h3>Report User</h3>
            </div>
            <div class="modal-body">
                <form action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                    <label for="message_report">Write your report here</label>
                        <textarea name="message_report" id="message_report" style="height:auto" class="form-control" rows="5"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary wew" data-dismiss="modal">Close</button>
                <button class="btn btn-info wew">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div> -->
  <!-- Page Content -->
            <div id="">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">User Profile</h4> </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                    <a href="#" id="reportBtn" data-uid="{{ Auth::id() }}" data-sid="{{ $user->id }}" style="color:red"><strong>Report User</strong></a>
                        <div class="white-box">
                            <div class="user-bg"> 
                            <img width="100%" alt="user" src="/uploads/blank.png">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        @if($user->avatar == null)
                                        <a href="javascript:void(0)" id="newDP" data-tooltip="true" title="Profile"><img src="/uploads/blank.png" id="imageSrc" class="thumb-lg img-circle" alt="img"></a>
                                        @else
                                        <a href="javascript:void(0)" id="newDP" data-tooltip="true" title="Profile"><img src="/{{ $user->avatar }}" id="imageSrc" class="thumb-lg img-circle" alt="img"></a>
                                        @endif
                                        <h4 class="text-white">{{ ucfirst($user->firstname) }} {{ ucfirst($user->lastname) }}</h4>
                                        <h5 class="text-white">{{ $user->email }}</h5> 
                                        <input id="input-1" EMAIl="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $user->userAverageRating }}" data-size="s" disabled="">
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
                                <li role="presentation" class="nav-item"><a href="#profile" class="nav-link active" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span></a></li>
                            </ul>
                            <div class="tab-content">
                               
                                <div class="tab-pane active" id="profile">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                            <br>
                                            <p class="text-muted">{{ $user->firstname }} {{ $user->lastname }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                            <br>
                                            <p class="text-muted">{{ $user->mobile_no }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Landline</strong>
                                            <br>
                                            <p class="text-muted">{{ $user->landline }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6"> <strong>Email</strong>
                                            <br>
                                            <p class="text-muted">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"><strong>Street No</strong>
                                           <br>
                                            <p class="text-muted">{{ $user->street_no }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"><strong>City</strong>
                                            <br>
                                            <p class="text-muted">{{ $user->city }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"><strong>Province</strong>
                                            <br>
                                            <p class="text-muted">{{ $user->province }}</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6"><strong>Zip Code</strong>
                                            <br>
                                            <p class="text-muted">{{ $user->zip_code }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($user->hasRoles('bidder'))
            <h3>Projects Done</h3>
            <table id="projectsDone">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Client</th>
                        <th>Bid</th>
                        <th>Status</th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td><a href="#">{{ ucfirst($project->title) }}</a></td>
                        <td>
                            <div class="clearfix">
                                <img src="/{{ $project->avatar }}" alt="avatar" style="width:100px;height:100px" class="gap-right img-thumbnail pull-left">
                                <p>
                                    <a href="{{ route('viewUser', ['user_id' => $project->user_id]) }}">{{ ucfirst($project->firstname) }} {{ ucfirst($project->lastname) }}</a>
                                    <br>
                                    <input id="input-1" name="input-1" data-min="0" data-step="0.1" data-max="5" value="{{ $user->userAverageRating }}" data-size="s" class="rating rating-loading" disabled>
                                    Reviews: {{ $user->userSumRating }} Reviews
                                </p>
                            </div>
                        </td>
                        <td>
                            <span>&#8369;</span> {{ $project->price }} in {{ $project->daysTodo }} days
                        </td>
                        <td>
                            Done
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy;  brought to you by BidPro </footer>
        </div>
        <!-- /#page-wrapper -->
@endsection
@section('scripts')
<script src="{{ asset('js/star-rating.js') }}"></script>
<script>
    $('#input-id').rating();
</script>
<script>
    $(function(){
        $('#projectsDone').DataTable();
    });
</script>
<script>
   $(function(){
       $('#reportBtn').click(function(){
        var uid = $(this).data('uid');
        var sid = $(this).data('sid');
        var textarea = document.createElement("textarea");
        textarea.rows = "4";
        textarea.cols="50";
        // textarea.placeholder="Write your report here";
        swal({
            title:"Report user",
            content: textarea,
            buttons:true
        }).then(function(value){
            if(value){
                $.ajax({
                    type: "post",
                    url: "{{ route('post.seeker') }}",
                    data:{
                        '_token': "{{ csrf_token() }}",
                        'seeker_id':uid,
                        'bidder_id':sid,
                        'message':textarea.value
                    },
                    cache:false,
                    success:function(response){
                        swal("Report Successful","Thanks for your report","success");
                    }
                });
            }else{
            swal("Report Cancelled","Error reporting user","error");
            }
        });
       });
   });
</script>
@endsection