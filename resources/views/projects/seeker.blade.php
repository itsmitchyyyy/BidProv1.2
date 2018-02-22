@extends('layouts.seekerapp')
@push('css')
<style>
.hidden{
  display:none;
}
.glyphicon-star:before{
    content: "\f005";
    font-family: FontAwesome;
}
.glyphicon-star-empty:before{
    content: "\f005";
    font-family: FontAwesome;
}
.gap-right{
  margin-right:10px;
}
</style>
@endpush
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
    <li class="nav-item" role="presentation">
      <a href="#ongoing" class="nav-link" aria-controls="ongoing" role="tab" data-toggle="tab">Ongoing Projects</a>
    </li>
    <li class="nav-item" role="presentation">
      <a href="#done" class="nav-link" role="tab" data-toggle="tab">Done Projects</a>
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
 
  @foreach($projects as $p => $project)
 @inject('proposals', 'App\Http\Controllers\ProjectController') 
  <tr>
    <td><a href="{{ route('myProject', ['id' => $project->id]) }}"><b>{{ ucwords($project->title) }}</b></a></td>
    <td>{{ $proposals->getProposal($project->id) }}</td>
    <td><span>&#8369;</span> {{ number_format($proposals->getPrice($project->id),2) }}</td>
    <td>{{ Carbon\Carbon::parse($project->duration)->diffForHumans() }}</td>
    <td>
      <button class="btn btn-link wew editBtn" title="Edit" data-tooltip="true" data-toggle="modal" data-target="#editModal{{ $project->id }}"><i class="fa fa-pencil-square-o"></i></button>
      <a href="{{ route('myProject', ['id' => $project->id]) }}"><button class="btn btn-link wew" data-tooltip="true" title="Award"><i style="color:yellow" class="fa fa-trophy"></i></button></a>
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
                    <?php $category = array('Mobile Development' => 'Mobile', 'Web Development' => 'Web', 'Mobile and Web Development' => 'MobileWeb', 'Desktop Application' => 'Desktop'); ?>
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
        <div id="emw">
        <div class="form-group m-b-30 m-t-15">
        <select name="type" id="type" class="form-control">
        <?php $category = array('IOS' => 'IOS', 'Android' => 'Android'); ?>
        <option value="" disabled selected></option>
                    @foreach($category as $categor => $val)
                      @if($val == $project->type)
                        <option value="{{ $val }}" selected>{{ $categor }}</option>
                      @else
                      <option value="{{ $val }}">{{ $categor }}</option>
                      @endif
                    @endforeach
          </select>
          <span class="highlight"></span><span class="bar"></span>
          <label for="type" class="text-dark">Mobile Type</label>
        </div>
        </div>
        <div id="eos">
        <div class="form-group m-b-30 m-t-15">
        <select name="os" id="ostype" class="form-control">
        <?php $category = array('Linux' => 'Linux', 'Windows' => 'Windows', 'Mac' => 'Mac'); ?>
                  <option value="" disabled selected></option>
                    @foreach($category as $categor => $val)
                      @if($val == $project->os)
                        <option value="{{ $val }}" selected>{{ $categor }}</option>
                      @else
                      <option value="{{ $val }}">{{ $categor }}</option>
                      @endif
                    @endforeach
          </select>
          <span class="highlight"></span><span class="bar"></span>
          <label class="text-dark" for="type">Os Type</label>
        </div>
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
            <button type="submit" id="projectUpdate"  class="btn btn-primary wew" style="background-color:#ee4b28;border:1px solid #ee4b28;">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <!-- END OF EDIT MODAL -->



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
           Your project will then be archived.
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary wew" data-dismiss="modal">Cancel</button>
          <form action="{{ route('closeproject', ['id' => $project->id]) }}" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="PATCH">
          <button type="submit" class="btn btn-info wew" >Yes</button>
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
  @inject('proposals', 'App\Http\Controllers\ProjectController') 
  <tr>
    <td><a href="{{ route('myProject', ['id' => $project->id]) }}"><b>{{ ucwords($project->title) }}</b></a></td>
    <td>{{ $proposals->getProposal($project->id) }}</td>
    <td><span>&#8369;</span> {{ number_format($proposals->getPrice($project->id),2) }}</td>
    <td>Closed</td>
    <td>
      <button class="btn btn-link wew " title="Repost" data-tooltip="true" data-toggle="modal" data-target="#repostModal{{ $project->id }}"><i class="fa fa-pencil-square-o"></i></button>
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
               {{ csrf_field() }}
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
                  <select name="category" id="categoryr" class="form-control">
                    <?php  $category = $category = array('Mobile Development' => 'Mobile', 'Web Development' => 'Web', 'Mobile and Web Development' => 'MobileWeb', 'Desktop Application' => 'Desktop'); ?>
                    @foreach($category as $categor => $val)
                      @if($val == $project->category)
                        <option value="{{ $val }}" selected>{{ $categor }}</option>
                      @else
                      <option value="{{ $val }}">{{ $categor }}</option>
                      @endif
                    @endforeach
                 </select>
                 <span class="highlight"></span><span class="bar"></span>
                 <label for="categoryr" class="text-dark">Category</label>
                 @if($errors->has('category'))
                    <p>{{ $errors->first('category') }}</p>
                 @endif
                </div>
                <!-- -->
                <div id="rmw">
        <div class="form-group m-b-30 m-t-15">
        <select name="type" id="rtype" class="form-control">
        <?php $category = array('IOS' => 'IOS', 'Android' => 'Android'); ?>
        <option value="" disabled selected></option>
                    @foreach($category as $categor => $val)
                      @if($val == $project->type)
                        <option value="{{ $val }}" selected>{{ $categor }}</option>
                      @else
                      <option value="{{ $val }}">{{ $categor }}</option>
                      @endif
                    @endforeach
          </select>
          <span class="highlight"></span><span class="bar"></span>
          <label for="type" class="text-dark">Mobile Type</label>
        </div>
        </div>
        <div id="ros">
        <div class="form-group m-b-30 m-t-15">
        <select name="os" id="rostype" class="form-control">
        <?php $category = array('Linux' => 'Linux', 'Windows' => 'Windows', 'Mac' => 'Mac'); ?>
                  <option value="" disabled selected></option>
                    @foreach($category as $categor => $val)
                      @if($val == $project->os)
                        <option value="{{ $val }}" selected>{{ $categor }}</option>
                      @else
                      <option value="{{ $val }}">{{ $categor }}</option>
                      @endif
                    @endforeach
          </select>
          <span class="highlight"></span><span class="bar"></span>
          <label class="text-dark" for="type">Os Type</label>
        </div>
        </div>
                <!--  -->
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
  </tr>
  @endforeach
  </tbody>
</table>
<!-- END OF TABLE -->
</div>
<div class="tab-pane" id="ongoing">
<table id="myOngoingProject" class="table table-bordered table-striped" width="100%" cellspacing="0">
  <thead>
    <tr>
    <th>Project Name</th>
    <th>Developer</th>
    <th>Bid</th>
      <th>Action</th>
    </tr>
  </thead>
  <tfoot>
  <tr>
      <th>Project Name</th>
      <th>Developer</th>
      <th>Bid</th>
      <th>Action</th>
    </tr>
  </tfoot>
  <tbody>
  @inject('users','App\Http\Controllers\RatingController')
  @foreach($ongoingprojects as $project)
  <tr>
    <td><a href="{{ route('acceptedBid', ['proposal_id' => $project->proposal_id, 'seeker_id' => $project->seeker_id, 'project_id' => $project->project_id]) }}"><b>{{ ucwords($project->title) }}</b></a></td>
    <td>
    <div class="clearfix">
      <img src="/{{$users->usersReview($project->bidder_id)->avatar}}" alt="avatar" style="height:100px;height:100px" class="pull-left gap-right">
      <p>
        <a href="{{ route('viewUser',['user_id' => $project->bidder_id]) }}">{{ ucfirst($users->usersReview($project->bidder_id)->firstname) }} {{ ucfirst($users->usersReview($project->bidder_id)->lastname) }} </a><br>
        <input id="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $users->usersReview($project->bidder_id)->userAverageRating }}" data-size="s" disabled>
        Reviews: {{ $users->usersReview($project->bidder_id)->userSumRating }} reviews
      </p>
    </div>
      </td>
    <td><span>&#8369;</span>{{ $project->price }} <br> in {{ $project->daysTodo }} days</td>
    <td>
      <a href="{{ route('acceptedBid', ['proposal_id' => $project->proposal_id, 'seeker_id' => $project->seeker_id, 'project_id' => $project->project_id]) }}" data-tooltip="true" title="View"><button class="btn btn-link wew"><i class="fa fa-eye" style="color:green"></i></button></a>
    <button class="btn btn-link wew " title="Cancel" data-tooltip="true" data-toggle="modal" data-target="#cancelProject{{ $project->id }}"><i class="fa fa-times"></i></button>
    </td>
    <!-- CANCEL PROJECT -->
      <div class="modal fade" id="cancelProject{{ $project->id }}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal"><span>&times;</span></button>
              <h3>Cancel Project</h3>
            </div>
            <div class="modal-body">
              <h3><b>Are you sure you want to cancel this project for <i class="fa fa-rouble"></i>200 PHP?</b></h3>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary wew" data-dismiss="modal">No</button>
              <form action="{{ route('cancelProject', ['id' => $project->project_id, 'bid_id' => $project->bid_id, 'project_name' => $project->title, 'user_paypal' => $project->paypal]) }}" method="POST">
                 {{ csrf_field() }}
              <input type="hidden" name="_method" value="PATCH">
              <button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border:1px solid #ee4b28">Yes</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <!-- END CANCEL -->
  </tr>
  @endforeach
  </tbody>
</table>
</div>
<div class="tab-pane" id="done">
  <table id="doneProjects">
    <thead>
      <tr>
        <th>Project Name</th>
        <th>Developer</th>
        <th>Bid</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($doneprojects as $dones)
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    @endforeach
    </tbody>
  </table>
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
          <select name="category" id="dcategory" class="form-control" required>
            <option disabled selected></option>
            <option value="Mobile">Mobile Development</option>
            <option value="Web">Web Development</option>
            <option value="MobileWeb">Mobile and Web Development</option>
            <option value="Desktop">Desktop Application</option>
          </select>
          <span class="highlight"></span><span class="bar"></span>
          <label for="dcategory">Category</label>
          @if($errors->has('category'))
              <p class="help-block">{{ $errors->first('category') }}</p>
            @endif
        </div>
        <!--  -->
        <div id="mw">
        <div class="form-group m-b-30 m-t-15">
        <select name="type" id="type" class="form-control">
            <option disabled selected></option>
            <option value="IOS">IOS</option>
            <option value="Android">Android</option>
            <option value="IAA">IOS and Android</option>
          </select>
          <span class="highlight"></span><span class="bar"></span>
          <label for="type">Mobile Type</label>
        </div>
        </div>
        <div id="os">
        <div class="form-group m-b-30 m-t-15">
        <select name="os" id="ostype" class="form-control">
            <option disabled selected></option>
            <option value="Linux">Linux</option>
            <option value="Windows">Windows</option>
            <option value="Mac">Mac</option>
          </select>
          <span class="highlight"></span><span class="bar"></span>
          <label for="type">Os Type</label>
        </div>
        </div>
        <!--  -->
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
          <div id="max_error"></div>
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
@section('scripts')
<script src="{{ asset('js/star-rating.js') }}"></script>
<script>
    $('#input-id').rating();
</script>
 <script>
     $(document).ready(function(){
         $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show');
     });
    </script>
    <script>
      $('#myModal').on('shown.bs.modal', function(){
        $('#max').keyup(function(){
          var min = $('#min').val();
          var max = $(this).val();
          var error = '';
          if(max < min){
            error = `<p style="color:red">Max price must be greater than minumum price</p>`; 
            $('#addBtn').prop('disabled',true);
          }
          else{
            $('#addBtn').prop('disabled','');
          }
          $('#max_error').html(error);
        });
      });
    </script>
<script>
    $(document).ready(function(){
        $('#myProject').DataTable();
        $('#myProjectClose').DataTable();
        $('#myOngoingProject').DataTable();
        $('#doneProjects').DataTable();
        
    });
</script>
<script>
        $('#min').change(function(){
            this.value = parseFloat(this.value).toFixed(2);
        });
        $('#max').change(function(){
            this.value = parseFloat(this.value).toFixed(2);
        });
    </script>
<script>
        var maxChar = 255;
        $('#charLeft').text(maxChar + ' characters left');
        $('#details').keyup(function(){
            var textLength = $(this).val().length;
            if(textLength >= maxChar){
                $('#charLeft').text('You have reached the limit of ' + maxChar + ' characters');
            } else {
                var count = maxChar - textLength;
                $('#charLeft').text(count + ' characters left');
            }
        });
    </script>
<script>
     @if(!empty(Session::get('adding_error')) && Session::get('adding_error') == 5)
            $('#myModal').modal('show');
            $('#myModal').data('bs.modal').handleUpdate();
     @endif
</script>
<script>
    @if(!empty(Session::get('repost_error')))
        $(document).ready(function(){
            $('#repostModal'+{{ Session::get('repost_error')}}).modal('show');
        });
    @endif
</script>
<script>
    $(".editBtn").on('click',function(e){
        var id = $(this).data('id');
        $('#editModal'+id).modal('show');
        //$('#projectUpdate').prop('disabled',true);
     
    });
</script>
<script>
    $(".closeBtn").on('click', function(){
        var id = $(this).data('id');
        $('#closeModal'+id).modal('show');
    });
</script>
<script>
    $(".deleteBtn").on('click', function(){
        var id = $(this).data('id');
        $('#deleteModal'+id).modal('show');
    });
</script>
<script>
    @if(!empty(Session::get('error_code')))
    $(document).ready(function(){
        $('#editModal'+{{Session::get('error_code')}}).modal('show');
    });
    @endif
</script>
<script>
  $(function(){
   $('#mw').addClass('hidden'); 
   $('#os').addClass('hidden'); 
  $('#dcategory').change(function(){
    var data = $(this).val();
    if(data == 'MobileWeb'){
      $('#type').attr("required", true);
      $('#ostype').attr("required", true);
      $('#mw').removeClass('hidden').addClass('show');
      $('#os').removeClass('hidden').addClass('show');
    }else if(data == 'Web'){
      $('#os').removeClass('hidden').addClass('show');
      $('#mw').removeClass('show').addClass('hidden');
      $('#ostype').attr("required", true);
    } else if(data == 'Mobile'){
      $('#mw').removeClass('hidden').addClass('show');
      $('#os').removeClass('show').addClass('hidden');
      $('#type').attr("required", true);
    }
    else{
      $('#mw').removeClass('show').addClass('hidden'); 
      $('#os').removeClass('show').addClass('hidden'); 
      $('#type').attr("required", false);
      $('#ostype').attr("required", false);
    }
  }).change();
  });
</script>
<script>
$(function(){
  $('#emw').addClass('hidden'); 
   $('#eos').addClass('hidden'); 
  $('#category').change(function(){
    var data = $(this).val();
    if(data == 'MobileWeb'){
      $('#type').attr("required", true);
      $('#ostype').attr("required", true);
      $('#emw').removeClass('hidden').addClass('show');
      $('#eos').removeClass('hidden').addClass('show');
    }else if(data == 'Web'){
      $('#eos').removeClass('hidden').addClass('show');
      $('#emw').removeClass('show').addClass('hidden');
      $('#type').val('');
      $('#type').attr("required", false);
      $('#ostype').attr("required", true);
    } else if(data == 'Mobile'){
      $('#emw').removeClass('hidden').addClass('show');
      $('#eos').removeClass('show').addClass('hidden');
      $('#type').attr("required", true);
      $('#ostype').attr("required", false);
      $('#ostype').val('');
    }
    else{
      $('#emw').removeClass('show').addClass('hidden'); 
      $('#eos').removeClass('show').addClass('hidden'); 
      $('#type').attr("required", false);
      $('#ostype').attr("required", false);
    }
  }).change();
  });
</script>
<script>
$(function(){
  $('#rmw').hide(); 
   $('#ros').hide(); 
  $('#categoryr').change(function(){
    var data = $(this).val();
    if(data == 'MobileWeb'){
      $('#rtype').attr("required", true);
      $('#rostype').attr("required", true);
      $('#rmw').show();
      $('#ros').show();
    }else if(data == 'Web'){
      $('#ros').show();
      $('#rmw').hide();
      $('#rtype').val('');
      $('#rtype').attr("required", false);
      $('#rostype').attr("required", true);
    } else if(data == 'Mobile'){
      $('#rmw').show();
      $('#ros').hide();
      $('#rtype').attr("required", true);
      $('#rostype').attr("required", false);
      $('#rostype').val('');
    }
    else{
      $('#rmw').hide(); 
      $('#ros').hide(); 
      $('#rtype').attr("required", false);
      $('#rostype').attr("required", false);
    }
  }).change();
  });
</script>
@endsection