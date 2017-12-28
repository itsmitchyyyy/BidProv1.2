@extends('layouts.bidderapp')
@section('content')
 

<div class="row">
  <div class="col-md-3 push-md-9">
 <h3 class="text-center">Top List</h3>
<div class="card w-100 m-t-10 m-b-5">
<div class="card-header">Test

</div>
<div class="card-block">
    
  <h4 class="card-title ml-2">Test </h4>
    <div class="row">
        <div class="col-md-12">
      
            <img src="uploads/blank.png" style="float:left;width:130px;height:100px; margin-right:10%; border-radius:50%;" alt="">
      
            <p class="card-text">
            
            </p>
            
        </div>
    </div>
  <button type="button" class="btn btn-info text-uppercase waves-effect waves-light float-right" style="background-color:#ee4b28;border:2px solid #ee4b28;" data-toggle="modal" data-target="#viewBidder1">View More</button>
</div>
</div>

 <!-- START OF VIEW PROFILE -->
 <div class="modal fade" id="viewBidder1" tabindex="-1" role="dialog" aria-labelledby="viewProfileLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="viewProfileLabel">Project Details</h5>
      </div>
      <div class="modal-body">
       Test
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary wew" data-dismiss="modal" >Close</button>
        <!--<button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border:2px solid #ee4b28">Delete</button>-->
      </div>
    </div>
  </div>
</div>
  <!-- END OF VIEW PROFILE -->

  </div>
  <div class="col-md-9 pull-md-3">
  <div class="form-group m-t-15">
  <input type="text" placeholder='&#xf002; Search' name="search" id="search" class="form-control search ml-auto" style="width:50%;">
  </div>
  
  @foreach($projects as $project)
<div class="card w-100 m-t-10 m-b-5">
<div class="card-header">{{ ucwords($project->title) }}

</div>
<div class="card-block">
    
  <h4 class="card-title ml-2">{{ ucwords($project->name) }} </h4>
    <div class="row">
        <div class="col-md-12">
        @if($project->avatar == null)
            <img src="uploads/blank.png" style="float:left;width:130px;height:100px; margin-right:10%; border-radius:50%;" alt="">
        @else
           <img src="{{ $project->avatar }}" style="float:left;width:130px;height:100px; margin-right:10%; border-radius:50%;" alt="">          
        @endif  
            <p class="card-text">
             {{ substr(ucfirst($project->details), 0, 150) }} ... 
            </p>
            
        </div>
    </div>
  <button type="button" class="btn btn-info text-uppercase waves-effect waves-light float-right" style="background-color:#ee4b28;border:2px solid #ee4b28;" data-toggle="modal" data-target="#viewProject{{ $project->project_id }}">View Project</button>
</div>
</div>

 <!-- START OF VIEW PROFILE -->
 <div class="modal fade" id="viewProject{{ $project->project_id }}" tabindex="-1" role="dialog" aria-labelledby="viewProfileLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="viewProfileLabel">Project Details</h5>
      </div>
      <div class="modal-body">
        <label>Project Title: <label><h3>{{ $project->title }}</h3>
        <label>Details: </label><h4>{{ $project->details }}</h4>
        <label>Start Date: </label><p>{{ $project->start }}</p>
        <label>Due Date: </label><p>{{ $project->end }}</p>
        <label>Category: </label><p>{{ $project->category }}</p>
        <label>Max Price: </label><p>{{ $project->cost }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary wew" data-dismiss="modal" >Close</button>
        <button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border:2px solid #ee4b28">Accept Bid</button>
      </div>
    </div>
  </div>
</div>
  <!-- END OF VIEW PROFILE -->
@endforeach
  </div>
</div>


 
</div>

@endsection