@extends('layouts.seekerapp')
@section('content')
<!--<div class="clearfix">
<img src="/uploads/blank.png" alt="" class=" rounded-circle float-left gap-right" style="width:100px;height:100px;margin-left:50px;">
<strong style="margin-left:15px;color:212834">Dr. Psych</strong>
<p>Hi<br>asds</p>
</div>-->

<div class="container-fluid m-t-10">

  <ul class="nav customtab nav-tabs m-t-15 m-b-30" id="tabMenu" role="tablist">
    <li class="nav-item" role="presentation">
      <a href="#open" class="nav-link active" aria-controls="open" role="tab" data-toggle="tab" aria-expanded="true">Open Projects</a>
    </li>
    <li class="nav-item" role="presentation">
      <a href="#closed" class="nav-link" aria-controls="closed" role="tab" data-toggle="tab" aria-expanded="false">Closed Projects</a>
    </li>
  </ul>
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissable fade show">
      <button type="button" data-dismiss="alert" class="close"><i class="fa fa-close"></i></button>
        {{ session()->get('error') }}
    </div>
    <?php Session::forget('error'); ?>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissable fade show">
      <button type="button" data-dismiss="alert" class="close"><i class="fa fa-close"></i></button>
        {{ session()->get('success') }}
    </div>
    <?php Session::forget('success'); ?>
    @endif
  <button type="button" class="m-b-30 btn btn-info text-uppercase waves-effect waves-light" style="background-color:#ee4b28;border:2px solid #ee4b28" data-toggle="modal" data-target="#myModal">
  POST
</button>
<div class="tab-content">
<div class="tab-pane active" id="open">
<!-- TABLE -->
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
    <td>{{ $project->title }}</td>
    <td>{{ $project->title }}</td>
    <td>{{ $project->title }}</td>
    <td>
      <button class="btn btn-link wew editBtn" title="Edit" data-tooltip="true" data-toggle="modal" data-target="#editModal{{ $project->id }}"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-link wew deleteBtn" data-tooltip="true" title="Delete" data-toggle="modal" data-id="{{ $project->id }}"><i class="text-danger fa fa-trash"></i></button>
      <button class="btn btn-link wew" data-tooltip="true" title="Award"><i style="color:yellow" class="fa fa-trophy"></i></button>
      <button class="btn btn-link wew closeBtn" data-tooltip="true" title="Close" data-toggle="modal" data-id="{{ $project->id }}"><i class="fa fa-close"></i></button>
    </td>
  <!-- EditMODAL -->
    <div class="modal fade" id="editModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
            <h3 class="modal-title" id="editModalLabel">Edit</h3>
          </div>
          <div class="modal-body">
            <form id="editForm" action="{{ route('updateproject', ['id' => $project->id]) }}" class="form-horizontal" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method" value="PATCH">
              <div class="floating-labels">
                <div class="form-group{{ $errors->has('titles') ? ' has-error' : ''}} m-b-40 m-t-15">
                  <input type="text" name="titles" id="title" class="form-control" value="{{ $project->title }}" required>
                  <span class="highlight"></span><span class="bar"></span>
                  <label for="titles" class="text-dark">Title</label>
                  @if($errors->has('titles'))
                    <p>{{ $errors->first('titles') }}</p>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('detailss') ? ' has-error' : ''}} m-b-40 m-t-15">
                  <textarea name="detailss" id="details" class="form-control" rows="4" style="height:auto" required>{{ $project->details}}</textarea>
                  <span class="highlight"></span><span class="bar"></span>
                  <label for="details" class="text-dark">Details</label>
                  @if($errors->has('detailss'))
                    <p>{{ $errors->first('detailss') }}</p>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('categorys') ? ' has-error' : ''}} m-b-40 m-t-15">
                  <select name="categorys" id="category" class="form-control">
                    <?php $category = array('--' => '--', 'Mobile Development' => 'Mobile', 'Web Development' => 'Web'); ?>
                    @foreach($category as $categor => $val)
                      @if($val == $project->category)
                        <option value="{{ $val }}" selected>{{ $categor }}</option>
                      @else
                      <option value="{{ $val }}">{{ $categor }}</option>
                      @endif
                    @endforeach
                 </select>
                 <span class="highlight"></span><span class="bar"></span>
                 <label for="category" class="text-dark">Category</label>
                 @if($errors->has('categorys'))
                    <p>{{ $errors->first('categorys') }}</p>
                 @endif
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary wew" data-dismiss="modal">Close</button>
            <button type="submit" id="projectUpdate"  class="btn btn-primary wew" style="background-color:#ee4b28;border:1px solid #ee4b28;">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <!-- END OF EDIT MODAL -->

  <!-- DELETE MODAL -->
  <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal{{ $project->id }}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Delete Project</h3>
        </div>
        <div class="modal-body">
          <h3><b>Are you sure you want to delete this project for <i class="fa fa-rouble"></i>200 PHP?</b></h3>
          <p style="font-weight:bold;margin-top:5%">Deleting your project will permanently remove it from our site so that no one will be able to view it. 
          All bids and attached files will be erased.
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary wew" data-dismiss="modal">Cancel</button>
          <form action="{{ route('deleteproject') }}" method="POST">
            {{ csrf_field() }}
            <?php Session::put('project_name', $project->title ); 
              Session::put('project_id', $project->id);
            ?>
            <!-- <input type="hidden" name="_method" value="DELETE"> -->
            <button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border:1px solid #ee4b28">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--END OF DELETE MODAL -->

  <!-- CLOSE PROJECT -->
  <div class="modal fade" tabindex="-1" role="dialog" id="closeModal{{ $project->id }}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Close Project</h3>
        </div>
        <div class="modal-body">
          <h3><b>Are you sure you want to close this project?</b></h3>
          <p style="font-weight:bold;margin-top:5%">
          By closing your project you will not be able to receive bids.
           Your project will then be archived and cannot be reopened.
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary wew" data-dismiss="modal">Cancel</button>
          <form action="{{ route('closeproject', ['id' => $project->id]) }}" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="PATCH">
          <button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border:1px solid #ee4b28;">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- END OF CLOSE PROJECT -->
  </tr>
  @endforeach
  </tbody>
</table>
<!-- END OF TABLE -->
</div>
<div class="tab-pane" id="closed">
<!-- TABLE -->
<table id="myProjectClose" class="table table-bordered table-striped" width="100%" cellspacing="0">
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
  @foreach($closedprojects as $project)
  <tr>
    <td><a href="#"><b>{{ ucwords($project->title) }}</b></a></td>
    <td>{{ $project->title }}</td>
    <td>{{ $project->title }}</td>
    <td>{{ $project->title }}</td>
    <td>
      <button class="btn btn-link wew " title="Repost" data-tooltip="true" data-toggle="modal" data-target="#repostModal{{ $project->id }}"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-link wew " data-tooltip="true" title="Delete" data-toggle="modal" data-target="#closedeleteModal{{ $project->id }}"><i class="text-danger fa fa-trash"></i></button>
    </td>
  <!-- EditMODAL -->
    <div class="modal fade" id="repostModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="repostModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
            <h3 class="modal-title" id="repostModalLabel">Repost Project</h3>
          </div>
          <div class="modal-body">
            <form action="{{ route('repostproject', ['id' => $project->id]) }}" class="form-horizontal" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PATCH">
              <div class="floating-labels">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : ''}} m-b-40 m-t-15">
                  <input type="text" name="title" id="title" class="form-control" value="{{ $project->title }}" required>
                  <span class="highlight"></span><span class="bar"></span>
                  <label for="titles" class="text-dark">Title</label>
                  @if($errors->has('title'))
                    <p>{{ $errors->first('title') }}</p>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('details') ? ' has-error' : ''}} m-b-40 m-t-15">
                  <textarea name="details" id="details" class="form-control" rows="4" style="height:auto" required>{{ $project->details}}</textarea>
                  <span class="highlight"></span><span class="bar"></span>
                  <label for="details" class="text-dark">Details</label>
                  @if($errors->has('details'))
                    <p>{{ $errors->first('details') }}</p>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('category') ? ' has-error' : ''}} m-b-40 m-t-15">
                  <select name="category" id="category" class="form-control">
                    <?php $category = array('--' => '--', 'Mobile Development' => 'Mobile', 'Web Development' => 'Web'); ?>
                    @foreach($category as $categor => $val)
                      @if($val == $project->category)
                        <option value="{{ $val }}" selected>{{ $categor }}</option>
                      @else
                      <option value="{{ $val }}">{{ $categor }}</option>
                      @endif
                    @endforeach
                 </select>
                 <span class="highlight"></span><span class="bar"></span>
                 <label for="category" class="text-dark">Category</label>
                 @if($errors->has('category'))
                    <p>{{ $errors->first('category') }}</p>
                 @endif
                </div>
                <div class="form-group m-b-40 m-t-15">
                  <input type="number" name="min" value="{{ $project->min }}" id="min" class="form-control" step="any" required>
                  <span class="highlight"></span><span class="bar"></span>
                  <label for="min" class="text-dark">Min Cost</label>
                </div>
                <div class="form-group m-b-40 m-t-15">
                  <input type="number" name="max" value="{{ $project->max }}" id="max" class="form-control" step="any" required>
                  <span class="highlight"></span><span class="bar"></span>
                  <label for="max" class="text-dark">Max Cost</label>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary wew" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border:1px solid #ee4b28;">Repost</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <!-- END OF REPOST MODAL -->

  <!-- CLOSED DELETE MODAL -->
  <div class="modal fade" tabindex="-1" role="dialog" id="closedeleteModal{{ $project->id }}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Delete Project</h3>
        </div>
        <div class="modal-body">
          <h3><b>Are you sure you want to delete this project for <i class="fa fa-rouble"></i>200 PHP?</b></h3>
          <p style="font-weight:bold;margin-top:5%">Deleting your project will permanently remove it from our site so that no one will be able to view it. 
          All bids and attached files will be erased.
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary wew" data-dismiss="modal">Cancel</button>
          <form action="{{ route('deleteproject', ['id' => $project->id]) }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border:1px solid #ee4b28">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--END OF CLOSED DELETE MODAL -->
  </tr>
  @endforeach
  </tbody>
</table>
<!-- END OF TABLE -->
</div>
</div>
<!-- ADD PROject -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="exampleModalLabel">Project Details</h3>
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
        <div class="form-group m-b-30 m-t-15{{ $errors->has('category') ? ' has-error' : ''}}">
          <select name="category" id="category" class="form-control" required>
            <option disabled selected></option>
            <option value="Mobile">Mobile Development</option>
            <option value="Web">Web Development</option>
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