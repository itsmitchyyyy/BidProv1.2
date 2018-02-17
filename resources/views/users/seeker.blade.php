@extends('layouts.seekerapp')
@push('css')
<style>
  .hidden{
  display:none;
}
</style>
@endpush
@section('content')

<div class="container">

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="exampleModalLabel">Project Details</h3>
      </div>
      <div class="modal-body">
        <div class="container">
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
        </div>
        </div>
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


  <div class="card w-100 m-t-15 mr-auto ml-auto">
    <div class="card-header">
      Recent Project
      <a href="{{ route('projects') }}" class="pull-right">View all</a>
    </div>
    <div class="card-body">
    @if($projects->isEmpty())
      <h3 class="card-title text-center">Post now</h3>
      <p class="text-center">Post a job</p>
      <div class="text-center">
      <button class=" btn btn-primary wew m-b-15" data-toggle="modal" data-target="#myModal" style="background-color:#ee4b28;;border:1px solid #ee4b28">POST</button>
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
          <button class="pull-right btn btn-primary wew m-b-10" data-toggle="modal" data-target="#myModal" style="background-color:#ee4b28;;border:1px solid #ee4b28">POST</button>
        </div>
        @endif
        </div>
    </div>
  </div>

  
   <!--row -->
   <!-- <div class="container-fluid m-t-15">
                    <div class="col-md-12 col-lg-12 col-sm-12" >
                        <div class="white-box " style="border:1px solid rgba(0,0,0,.125); border-radius:.25rem">
                            <h3 class="box-title">Activity Feed</h3>
                            <hr style="background-color:rgba(0,0,0,.125)">
                            <div class="comment-center">
                                <div class="comment-body" style="border-bottom:1px solid rgba(0,0,0,0.125);">
                                    <div class="user-img"> <img src="/img/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                                    <div class="mail-contnet">
                                        <h5>Pavan kumar</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span> <span class="label label-rouded label-info">PENDING</span><a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2017</span></div>
                                </div> -->
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
                      <!--       </div>
                        </div>
                    </div>
                </div> -->

</div>
@endsection
@push('scripts')
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
@endpush