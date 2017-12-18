@extends('layouts.seekerapp')
@section('content')
 
<div class="container">
  <button type="button" class="btn btn-info text-uppercase waves-effect waves-light" style="background-color:#ee4b28;border:2px solid #ee4b28" data-toggle="modal" data-target="#myModal">
  POST
</button>

@foreach($projects as $project)
<div class="card w-75 ">
<div class="card-header">{{ ucwords($project->name) }}
<a href="http://" class="action-button float-right"><i class="fa fa-trash"></i></a>
</div>
<div class="card-block">
    
  <h4 class="card-title">Project Title: {{ $project->title }} </h4>
    <div class="row">
        <div class="col-md-12">
            <img src="uploads/blank.png" style="float:left;width:150px;height:100px; margin-right:10%; border-radius:50%;" alt="">
            <p class="card-text">Details: {{ ucfirst($project->details) }} 
            <br>Date Start: {{ $project->start }}
            <br>Date End: {{ $project->end }}
            <br>Cost: {{ $project->cost }}<i class="fa fa-dollar"></i> 
            </p>
        </div>
    </div>
  <a href="#" class="btn btn-info">View Profile</a>
</div>
</div>
@endforeach
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Project Details</h5>
      </div>
      <div class="modal-body">
            <form action="{{ route('seeker') }}" class="form-horizontal form-material" method="post">
                {{ csrf_field() }}
            <div class="form-group row{{ $errors->has('title') ? ' has-error' : ''}}">
                <label for="title" class="col-2 col-form-label " >Title</label>
                <div class="col-10">
                 <input type="text" name="title" id="title" class="form-control" placeholder=" Title" aria-labelledby="errorHelpBlock">
                @if($errors->has('title'))
                    <small id="errorHelpBlock"  class="help-block text-danger">{{ $errors->first('title') }}</small>   
                 @endif  
            </div>
            </div>
            <div class="form-group row{{ $errors->has('details') ? ' has-error' : ''}}">
                <label for="details" class="col-2 col-form-label">Details</label>
                <div class="col-10">
                    <textarea name="details" id="details" cols="30" rows="10" class="form-control"  placeholder="Details" aria-labelledby="errorHelpBlock"></textarea>
                    @if($errors->has('details'))
                    <small id="errorHelpBlock" class="help-block text-danger">{{ $errors->first('details') }}</small>   
                    @endif  
                </div>
            </div>
            <div class="form-group row{{ $errors->has('start') ? ' has-error' : ''}}">
                <label for="start" class="col-2 col-form-label">Date Start</label>
                <div class="col-10 ">   
                    <input type="date" name="start" id="start" placeholder="Date Start" aria-labelledby="errorHelpBlock"   class="form-control">
                    @if($errors->has('start'))
                    <small id="errorHelpBlock" class="help-block text-danger">{{ $errors->first('start') }}</small>   
                    @endif  
                </div>
            </div>    
            <div class="form-group row{{ $errors->has('end') ? ' has-error' : ''}}">
                <label for="end" class="col-2 col-form-label">Date End</label>
                <div class="col-10">
                    <input type="date" name="end" id="end" placeholder="Date End" aria-labelledby="errorHelpBlock"  class="form-control">
                    @if($errors->has('end'))
                    <small id="errorHelpBlock" class="help-block text-danger">{{ $errors->first('end') }}</small>   
                    @endif  
                </div>
            </div>
            <div class="form-group row{{ $errors->has('category') ? ' has-error' : ''}}">
                <label for="category" class="col-2 col-form-label">Category</label>
                <div class="col-10">
                    <select name="category" id="category" class="form-control" aria-labelledby="errorHelpBlock">
                        <option value="0" disabled selected>Choose category</option>
                        <option value="Test">Test</option>
                        <option value="Test">Test</option>
                        <option value="Test">Test</option>
                    </select>
                    @if($errors->has('category'))
                    <small id="errorHelpBlock" class="help-block text-danger">{{ $errors->first('category') }}</small>   
                    @endif  
                </div>
            </div>
            <div class="form-group row{{ $errors->has('cost') ? ' has-error' : ''}}">
                <label for="cost" class="col-2 col-form-label">Cost</label>
                <div class="col-10">
                    <input type="number" step="any" name="cost" id="cost" placeholder=" Cost" class="form-control" aria-labelledby="errorHelpBlock">
                    @if($errors->has('cost'))
                    <small id="errorHelpBlock" class="help-block text-danger">{{ $errors->first('cost') }}</small>   
                    @endif  
                </div>
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
  
</div>

@endsection