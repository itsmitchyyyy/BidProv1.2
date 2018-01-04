@extends('layouts.seekerapp')
@section('content')

<div class="container">
  <div class="card w-75 m-t-15 mr-auto ml-auto">
    <div class="card-header">
      Recent Project
      <a href="{{ route('projects') }}" class="pull-right">View all</a>
    </div>
    <div class="card-body">
    @if($projects->isEmpty())
      <h3 class="card-title text-center">Post now</h3>
      <p class="text-center">Post a job</p>
      <div class="text-center">
      <button class=" btn btn-primary wew m-b-15" style="background-color:#ee4b28;;border:1px solid #ee4b28">POST</button>
      </div>
      @else
      <p class="card-text">
      @foreach($projects as $project)
          <div class="card m-t-15 w-75 mr-auto ml-auto">
            <div class="card-header">
              <h3 class="card-title"><b>{{ ucwords($project->title) }}</b></h3>
            </div>
            <div class="card-body">
              <h3 class="card-title">Test</h3>
            </div>
          </div>
      @endforeach
        </p>
      @endif
      @if(!$projects->isEmpty())
        <div class="card-footer">
          <button class="pull-right btn btn-primary wew m-b-10" style="background-color:#ee4b28;;border:1px solid #ee4b28">POST</button>
        </div>
        @endif
        </div>
    </div>
  </div>
   <!--row -->
   <div class="container-fluid m-t-15">
                    <div class="col-md-12 col-lg-12 col-sm-12" >
                        <div class="white-box " style="border:1px solid rgba(0,0,0,.125); border-radius:.25rem">
                            <h3 class="box-title">Activity Feed</h3>
                            <hr style="background-color:rgba(0,0,0,.125)">
                            <div class="comment-center">
                                <div class="comment-body" style="border-bottom:1px solid rgba(0,0,0,0.125);">
                                    <div class="user-img"> <img src="/img/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                                    <div class="mail-contnet">
                                        <h5>Pavan kumar</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span> <span class="label label-rouded label-info">PENDING</span><a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2017</span></div>
                                </div>
                               <!-- <div class="comment-body" style="border-bottom:1px solid rgba(0,0,0,.125);">
                                    <div class="user-img"> <img src="/img/users/sonu.jpg" alt="user" class="img-circle"> </div>
                                    <div class="mail-contnet">
                                        <h5>Sonu Nigam</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span><span class="label label-rouded label-success">APPROVED</span><a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2017</span></div>
                                </div>
                                <div class="comment-body">
                                    <div class="user-img"> <img src="/img/users/arijit.jpg" alt="user" class="img-circle"> </div>
                                    <div class="mail-contnet">
                                        <h5>Arijit Sinh</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat. </span><span class="label label-rouded label-danger">REJECTED</span><a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2017</span></div>
                                </div>
                                <div class="comment-body b-none">
                                    <div class="user-img"> <img src="/img/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                                    <div class="mail-contnet">
                                        <h5>Pavan kumar</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span> <span class="label label-rouded label-info">PENDING</span> <a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2017</span></div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>

</div>
@endsection