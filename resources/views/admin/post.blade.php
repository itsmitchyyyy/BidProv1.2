@extends('layouts.adminlayout')
@section('content')
 <!-- Page Content -->
 <div id="page-wrapper">
   <div class="container-fluid">
       <div class="row bg-title">
           <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
               <h4 class="page-title">Post</h4>
           </div>
           <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
               <ol class="breadcrumb">
                   <li><a href="#">Post</a></li>
                   <li class="active">List of Post</li>
               </ol>
           </div>
           <!-- /.col-lg-12 -->
       </div>
 
<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

<!-- ADD PROJECT -->

<div class="card ">
<div class="card-header">Project Title: 
<a href="http://" class="action-button float-right"><i class="fa fa-trash"></i></a>
</div>
<div class="card-block">
    
  <h4 class="card-title m-l-20"> </h4>
    <div class="row">
        <div class="col-md-12">
            <img src="/uploads/blank.png" style="float:left;width:150px;height:100px; margin-right:10%; border-radius:50%;" alt="">
            <p class="card-text">Project Details:  
            </p>
        </div>
    </div>
  <button type="button" class="btn btn-info text-uppercase waves-effect waves-light float-right" style="background-color:#ee4b28;border:2px solid #ee4b28;" data-toggle="modal" data-target="#viewProfile">View Project</button>
</div>
</div>

  <!-- START OF VIEW PROFILE -->
  <div class="modal fade" id="viewProfile" tabindex="-1" role="dialog" aria-labelledby="viewProfileLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="viewProfileLabel">Profile Details</h5>
      </div>
      <div class="modal-body">
            
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary wew" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary wew" style="background-color:#ee4b28;border:2px solid #ee4b28" >Approve</button>
        <button type="submit" class="btn btn-primary wew" style="background-color:#ee2b28;border:2px solid #ee2b28">Disapprove</button>
      </div>
    </div>
  </div>
</div>
  <!-- END OF VIEW PROFILE -->
</div>


       </div> 
@endsection