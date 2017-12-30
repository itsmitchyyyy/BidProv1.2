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
 <div class="modal fade viewModal" id="viewProject{{ $project->project_id }}" tabindex="-1" role="dialog" aria-labelledby="viewProfileLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="viewProfileLabel">Project Details</h5>
      </div>
      <div class="modal-body">
        <b>Project Title: </b><h3>{{ $project->title }}</h3>
        <label>Details: </label><h4>{{ $project->details }}</h4>
        <label>Start Date: </label><p>{{ $project->start }}</p>
        <label>Due Date: </label><p>{{ $project->end }}</p>
        <label>Category: </label><p>{{ $project->category }}</p>
        <label>Max Price: </label><p>{{ $project->cost }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary wew" data-dismiss="modal" >Close</button>
        <button type="submit" class="btn btn-primary wew proposeBtn" style="background-color:#ee4b28;border:2px solid #ee4b28" data-id="{{ $project->project_id }}" data-toggle="modal">Propose</button>
      </div>
    </div>
  </div>
</div>
  <!-- END OF VIEW PROFILE -->

  <!-- PROPOSE MODAL -->
<div class="modal fade proposeModal" id="proposeModal{{ $project->project_id }}" tab-index="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close"  data-toggle="modal" data-dismiss="modal" data-target="#viewProject{{ $project->project_id }}"><i class="fa fa-close"></i></button>
        <h3 class="modal-title">Proposal</h3>
      </div>
      <div class="modal-body">
        <form action="" class="form-horizontal">
          <div class="floating-labels">
            <div class="form-group">
              <textarea name="details" id="details" style="height:auto" class="form-control" rows="4" maxlength="255" required></textarea>
              <span class="highlight"></span><span class="bar"></span>
              <label for="details">Proposal Details</label>
            </div>
          </div>
          <div class="floating-labels">
            <div class="form-group">
              <input type="number" name="price" id="price" class="form-control" required>
              <span class="highlight"></span><span class="bar"></span>
              <label for="price">Price</label>
            </div>
          </div>
          <div class="floating-labels">
            <div class="form-group">
              <input type="text" name="date" id="date" class="form-control"  required>
              <span class="highlight"></span><span class="bar"></span>
              <label for="Date">Duration</label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary wew" data-toggle="modal" data-dismiss="modal" data-target="#viewProject{{ $project->project_id }}">Cancel</button>
        <button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border-bottom-color:#ee4b28">Submit</button>
      </div>
    </div>
  </div>
</div>
@endforeach
  </div>
</div>


 
</div>

@endsection