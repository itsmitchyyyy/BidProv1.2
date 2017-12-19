@extends('layouts.seekerapp')
@section('content')
 
<div class="container m-t-10">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
  <button type="button" class="btn btn-info text-uppercase waves-effect waves-light" style="background-color:#ee4b28;border:2px solid #ee4b28" data-toggle="modal" data-target="#myModal">
  POST
</button>
<!-- ADD PROJECT -->

@foreach($projects as $project)
<div class="card w-75 m-t-10 m-b-5">
<div class="card-header">{{ ucwords($project->title) }}
<a href="http://" class="action-button float-right"><i class="fa fa-gavel"></i></a>
</div>
<div class="card-block">
    
  <h4 class="card-title ml-2">{{ ucwords($project->name) }} </h4>
    <div class="row">
        <div class="col-md-12">
            <img src="uploads/blank.png" style="float:left;width:130px;height:100px; margin-right:10%; border-radius:50%;" alt="">
            <p class="card-text">
             {{ substr(ucfirst($project->details), 0, 150) }} ... 
            </p>
            
        </div>
    </div>
  <button type="button" class="btn btn-info text-uppercase waves-effect waves-light float-right" style="background-color:#ee4b28;border:2px solid #ee4b28;" data-toggle="modal" data-target="#viewProject{{ $project->project_id }}">View More</button>
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
        Details: {{ $project->details }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary wew" data-dismiss="modal" >Close</button>
        <!--<button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border:2px solid #ee4b28">Delete</button>-->
      </div>
    </div>
  </div>
</div>
  <!-- END OF VIEW PROFILE -->
@endforeach
<!-- ADD PROject -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Project Details</h5>
      </div>
      <div class="modal-body">
       
            <form action="{{ route('seeker') }}" class="floating-labels" method="post">
                {{ csrf_field() }}
        <div class="form-group{{ $errors->has('title') ? ' has-error' : ''}} m-b-40 m-t-15">
            <input type="text" name="title" id="title" class="form-control" required>
            <span class=""></span><span class="bar"></span>
            <label for="title">Title</label>
            @if($errors->has('title'))
              <p class="text-danger help-block">{{ $errors->first('title') }}</p>
            @endif
        </div>
        <div class="form-group m-b-30 m-t-15{{ $errors->has('details') ? ' has-error' : ''}}">
            <textarea name="details" maxlength="255" id="details" rows="4"  class="form-control" style="height:auto" required></textarea>
            <span class=""></span><span class="bar"></span>
            <label for="details">Details</label>
            @if($errors->has('details'))
              <p class="text-danger help-block">{{ $errors->first('details') }}</p>
              @else
              <span class="help-block float-right"><small id="charLeft"></small></span>
            @endif
        </div>
        <div class="form-group m-b-30 m-t-15{{ $errors->has('start') ? ' has-error' : ''}}">
            <input  type="text" name="start" id="start" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')" required>
            <span class="highlight"></span><span class="bar"></span>
            <label for="start">Date Start</label>
            @if($errors->has('start'))
              <p class="help-block">{{ $errors->first('start') }}</p>
            @endif
        </div>
        <div class="form-group m-b-30 m-t-15{{ $errors->has('end') ? ' has-error' : ''}}">
          <input type="text" name="end" id="end" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')" required>
          <span class="highlight"></span><span class="bar"></span>
          <label for="end">Date End</label>
          @if($errors->has('end'))
              <p class="help-block">{{ $errors->first('end') }}</p>
            @endif
        </div>
        <div class="form-group m-b-30 m-t-15{{ $errors->has('category') ? ' has-error' : ''}}">
          <select name="category" id="category" class="form-control" required>
            <option disabled selected></option>
            <option value="Test1">Test1</option>
            <option value="Test2">Test2</option>
            <option value="Test3">Test3</option>
          </select>
          <span class="highlight"></span><span class="bar"></span>
          <label for="category">Category</label>
          @if($errors->has('category'))
              <p class="help-block">{{ $errors->first('category') }}</p>
            @endif
        </div>
        <div class="form-group m-b-5 m-t-15{{ $errors->has('cost') ? ' has-error' : ''}}">
            <input type="number" step="any"  name="cost" id="cost" class="form-control" required>
            <span class="highlight"></span><span class="bar"></span>
            <label for="cost">Cost</label>
            @if($errors->has('cost'))
              <p class="help-block">{{ $errors->first('cost') }}</p>
            @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary wew" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border:2px solid #ee4b28">Post</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <!-- END OF ADD PROJECT -->

 
</div>

@endsection