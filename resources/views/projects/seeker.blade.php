@extends('layouts.seekerapp')
@section('content')
 
<div class="container-fluid m-t-10">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
  <button type="button" class="m-b-30 btn btn-info text-uppercase waves-effect waves-light" style="background-color:#ee4b28;border:2px solid #ee4b28" data-toggle="modal" data-target="#myModal">
  POST
</button>
<table id="myProject" class="table table-bordered table-striped" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Project Name</th>
      <th>Number of Bids</th>
      <th>Highest Bid</th>
      <th>Bid Duration</th>
      <th>Action</th>
    </tr>
  </thead>
  <tfoot>
  <tr>
      <th>Project Name</th>
      <th>Number of Bids</th>
      <th>Highest Bid</th>
      <th>Bid Duration</th>
      <th>Action</th>
    </tr>
  </tfoot>
  <tbody>
  @foreach($projects as $project)
  <tr>
    <td><a href="#"><b>{{ ucwords($project->title) }}</b></a></td>
    <td>{{ $project->name }}</td>
    <td>{{ $project->name }}</td>
    <td>{{ $project->name }}</td>
    <td>
      <button class="btn btn-link wew" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-link wew" data-toggle="tooltip" title="Delete"><i class="text-danger fa fa-trash"></i></button>
      <button class="btn btn-link wew" data-toggle="tooltip" title="Award"><i style="color:yellow" class="fa fa-trophy"></i></button>
      <button class="btn btn-link wew" data-toggle="tooltip" title="Close"><i class="fa fa-close"></i></button>
    </td>
  </tr>
  @endforeach
  </tbody>
</table>


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
       
            <form action="{{ route('seeker') }}" class="form-horizontal" method="post">
                {{ csrf_field() }}
                <div class="floating-labels">
        <div id="form-group" class="form-group{{ $errors->has('title') ? ' has-error' : ''}} m-b-40 m-t-15">
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
        <div class="form-group m-b-30 m-t-15{{ $errors->has('min') ? ' has-error' : ''}}">
            <input type="number" step="any"  name="min" id="min" class="form-control" required>
            <span class="highlight"></span><span class="bar"></span>
            <label for="min">Min Cost</label>
            @if($errors->has('min'))
              <p class="help-block">{{ $errors->first('min') }}</p>
            @endif
        </div>
        <div class="form-group m-b-30 m-t-15{{ $errors->has('max') ? ' has-error' : ''}}">
          
          <input type="number"  name="max" id="max" step="any" class="form-control" required>
          <span class="highlight"></span><span class="bar"></span>
          <label for="max">Max Price</label>
          @if($errors->has('max'))
            <p class="help-block">{{ $errors->first('max') }}</p>
          @endif
        </div>
        </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary wew" data-dismiss="modal">Close</button>
        <button type="submit" id="addBtn" class="btn btn-primary wew" style="background-color:#ee4b28;border:2px solid #ee4b28">Post</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <!-- END OF ADD PROJECT -->

 
</div>

@endsection