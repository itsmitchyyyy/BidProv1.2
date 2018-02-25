@extends('layouts.bidderapp')
@section('content')
<div class="container-fluid">
@if(session()->has('error'))
    <div class="alert alert-danger fade show alert-dismissable">
        <button type="button" data-dismiss="alert" class="close"><span>&times;</span></button>
    {{ session()->get('error') }}
    </div>
@endif
@inject('proposal_modules', 'App\Http\Controllers\BidderController')
@foreach($proposals as $proposal)
<h3><b>{{ ucfirst($proposal->title) }}</b></h3>
<div class="card">
    <div class="card-block">
        <div style="border-right:1px solid black; width:4em;" class="pull-left "><p><b>BIDS</b><br>{{ $count_bid }}</p></div>
        <div style="border-right:1px solid black;width:10em;" class="pull-left m-l-10 "><p><b>Avg Bid (PHP)</b><br><span>&#8369;</span>{{ number_format($avg,2) }} </p></div>
        <div style="width:20em" class="pull-left m-l-10"><p><b>Project Budget (PHP)</b><br><span>&#8369;</span> {{ $proposal->min }} - <span>&#8369;</span> {{ $proposal->max }}</p></div>
        <div class="pull-right m-r-15"><p><b>{{ Carbon\Carbon::parse($proposal->duration)->diffForHumans() }}</b><h3 class="text-center">@if($proposal->duration > Carbon\Carbon::now()) OPEN @else CLOSED @endif </h3></p></div>
    </div>
</div>
</div>
<div class="card m-t-15">
    <div class="card-block">
        <p class="card-text">
        <h3><b>Edit Proposal</b></h3>
        <!-- <a href="#" id="addModule">Add more</a> -->
            <form action="{{ route('update.proposal', ['proposal_id' => $proposal_details->id,'project_id' => $proposal->id]) }}" id="myForm" method="post" class="m-t-30">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PATCH">
                    <a href="#" id="addMore">Add more module</a>
                   <div style="border:1px solid rgba(0,0,0,.25)" id="moduleHeader">
                   <p>
                   @foreach($module_details as $details)
                   <div class="p-10 mt-3" style="border-bottom:1px solid rgba(0,0,0,.25)">
                   <input type="hidden" name="module_id[]" value="{{ $proposal_modules->getModules($details->id)->id }}">
                   <div class="floating-labels">
                   
                            <div class="form-group">
                                <input type="text" name="module_name[]" id="module_name" value="{{ $details->module_name }}" required class="form-control">
                                <span class="highlight"></span><span class="bar"></span>
                                <label for="module_name">Module Name</label>
                            </div>
                        </div>
                        </div>
                        <div style="border-bottom:1px solid rgba(0,0,0,.25)" class="p-10 mt-3">
                            <div class="floating-labels">
                            <p>
                            @foreach($proposal_modules->showProposalModules($details->id) as $modules)
                            <div class="form-group">
                            <input type="hidden" name="proposal_moduleID[]" value="{{ $modules->id }}">
                            <input type="text" name="module_description[]" value="{{ $modules->description }}" id="{{ $modules->description }}" required class="form-control">
                            <span class="highlight"></span><span class="bar"></span>
                            <label for="{{ $modules->description }}">Module Description</label>
                            </div>
                            @endforeach
                           <!--  <div class="form-group">
                            <input type="text" name="module_description[]" value="Retrieve" id="module_descriptionn" required class="form-control">
                            <span class="highlight"></span><span class="bar"></span>
                            <label for="module_descriptionn">Module Description</label>
                            </div>
                            <div class="form-group">
                            <input type="text" name="module_description[]" value="Update"  id="module_descriptionnn" required class="form-control">
                            <span class="highlight"></span><span class="bar"></span>
                            <label for="module_descriptionnn">Module Description</label>
                            </div>
                            <div class="form-group">
                            <input type="text" name="module_description[]" value="Delete" id="module_descriptionnnn" required class="form-control">
                            <span class="highlight"></span><span class="bar"></span>
                            <label for="module_descriptionnnn">Module Description</label> 
                            </div>-->
                            </p>
                        </div>
                   </div>
                   @endforeach
                   </p>
                   </div>
                   <div style="border:1px solid rgba(0,0,0,.25)" class="p-10">
                   <div class="floating-labels">
                    <div class="form-group mt-3" id="price_div">
                        <input type="text" name="proposal_price" value="{{ $proposal_details->price }}" id="proposal_price" class="form-control" required>
                        <span class="highlight"></span><span class="bar"></span>
                        <label for="proposal_price">Price</label>
                        <div id="price_error"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="proposal_days" value="{{ $proposal_details->daysTodo }}" id="proposal_days" class="form-control" required>
                        <span class="highlight"></span><span class="bar"></span>
                        <label for="proposal_days">Days to do</label>
                    </div>
                   </div>
                   </div>
                    <button type="submit" id="btnSubmit" class="btn btn-info wew pull-right mt-1">Update</button>
            </form>
        </p>
    </div>
</div>
@endforeach
</div>
@endsection
@section('scripts')
<script>
    $('#proposal_price').change(function(){
        this.value = parseFloat(this.value).toFixed(2);
    })
</script>
<script>
$(function(){
    var moduleHeader = $('#moduleHeader');
    var i = $('#module_name p').length + 1;
    $('#addMore').click(function(){
        i++;
        $(`<p class="mt-2" >
                   <div class="p-10 mt-3" style="border-bottom:1px solid rgba(0,0,0,.25);border-top:1px solid rgba(0,0,0,.25)">
                   <input type="hidden" name="module_id[]" value="">
                   <div class="floating-labels mt-3">
                            <div class="form-group">
                                <input type="text" name="module_name[]" id="module_name`+i+`" required class="form-control">
                                <span class="highlight"></span><span class="bar"></span>
                                <label for="module_name`+i+`">Module Name</label>
                            </div>
                        </div>
                        </div>
                        <div style="border-bottom:1px solid rgba(0,0,0,.25)" class="p-10 mt-3">
                        <div class="floating-labels">
                                <p>
                                <div class="form-group">
                                <input type="hidden" name="proposal_moduleID[]" value="<?php echo rand(); ?>`+i+`">
                                <input type="text" name="module_description[]" value="Create" id="module_description`+i+`" required class="form-control">
                                <span class="highlight"></span><span class="bar"></span>
                                <label for="module_description`+i+`">Module Description</label>
                                </div>
                                
                                <div class="form-group">
                                <input type="hidden" name="proposal_moduleID[]" value="<?php echo rand(); ?>`+i+`">
                                <input type="text" name="module_description[]" value="Retrieve" id="module_descriptionn`+i+`" required class="form-control">
                                <span class="highlight"></span><span class="bar"></span>
                                <label for="module_descriptionn`+i+`">Module Description</label>
                                </div>
                                <div class="form-group">
                                <input type="hidden" name="proposal_moduleID[]" value="<?php echo rand(); ?>`+i+`">
                                <input type="text" name="module_description[]" value="Update"  id="module_descriptionnn`+i+`" required class="form-control">
                                <span class="highlight"></span><span class="bar"></span>
                                <label for="module_descriptionnn`+i+`">Module Description</label>
                                </div>
                                <div class="form-group">
                                <input type="hidden" name="proposal_moduleID[]" value="<?php echo rand(); ?>`+i+`">
                                <input type="text" name="module_description[]" value="Delete" id="module_descriptionnnn`+i+`" required class="form-control">
                                <span class="highlight"></span><span class="bar"></span>
                                <label for="module_descriptionnnn`+i+`">Module Description</label>
                                </div>
                                </p>
                        </div>
                   </div>
                   </p>`).appendTo(moduleHeader);
                   return false;
    });    
    

});
</script>
<script>
   $(function(){
    //    $('#btnSubmit').prop('disabled',true);
       $('#proposal_price').keyup(function(){
        @foreach($proposals as $proposal)
            var min = {{$proposal->min}}
            var max = {{$proposal->max}}
            var current = $(this).val();
            var days = $('#proposal_days').val();
            if(current < min){
                console.log('greater than');
                $('#price_div').addClass("has-error");    
                $('#price_error').html('<p style="color:red">Must be in between the given price</p>');
                $('#btnSubmit').prop('disabled',true);
            }
            else if(current > max){
                console.log('lesser than');
            }

            else{
                $('#btnSubmit').prop('disabled','');
                $('#price_div').removeClass("has-error");    
                $('#price_error').html('');
            }
       @endforeach
       });
   });
</script>
@endsection