@extends('layouts.bidderapp')
@section('content')
<div class="container-fluid m-t-15">
@if(session()->has('error'))
    <div class="alert alert-danger fade show alert-dismissable">
        <button type="button" data-dismiss="alert" class="close"><span>&times;</span></button>
    {{ session()->get('error') }}
    </div>
@endif
@foreach($proposals as $proposal)
<h3><b>{{ ucfirst($proposal->title) }}</b></h3>
<div class="card">
    <div class="card-block">
        <div style="border-right:1px solid black; width:4em;" class="pull-left "><p><b>BIDS</b><br>@if($proposals->isEmpty()) 0 @else {{ count($proposal->proposals) }} @endif</p></div>
        <div style="border-right:1px solid black;width:10em;" class="pull-left m-l-10 "><p><b>Avg Bid (PHP)</b><br><span>&#8369;</span>@if($proposal->proposals->isEmpty()) 0 @else {{ number_format($avg,2) }} @endif</p></div>
        <div style="width:20em" class="pull-left m-l-10"><p><b>Project Budget (PHP)</b><br><span>&#8369;</span> {{ $proposal->min }} - <span>&#8369;</span> {{ $proposal->max }}</p></div>
        <div class="pull-right m-r-15"><p><b>{{ Carbon\Carbon::parse($proposal->duration)->diffForHumans() }}</b><h3 class="text-center">@if($proposal->duration > Carbon\Carbon::now()) OPEN @else CLOSED @endif </h3></p></div>
    </div>
</div>
</div>
<div class="card m-t-15">
    <div class="card-block">
        <p class="card-text">
        <h3><b>Proposal</b></h3>
            <form action="{{ route('proposetome', ['project_id' => $proposal->id, 'user_id' => $proposal->user_id]) }}" method="post" class="m-t-30">
                {{ csrf_field() }}
                <div class="floating-labels">
                    <div class="form-group" id="divModule">
                        <p>
                        <textarea name="description[]" id="description"  rows="4" class="m-t-15 form-control" style="height:auto;<?php echo (count($errors) > 0) ? ' border-bottom:1px solid red':'border-bottom:1px solid rgba(0,0,0,.25)'?>" placeholder="Details here..."></textarea>
                        <input type="text" name="days[]" id="days" class="m-t-15 form-control form-control-line" style="<?php echo (count($errors) > 0) ? ' border-bottom:1px solid red':'border-bottom:1px solid rgba(0,0,0,.25)'?>" placeholder="Days to do">
                        </p>
                        <a href="#" id="addModule">Add more module</a>
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" class="form-control" id="asd" required>
                        <span class="highlight"></span><span class="bar"></span>
                        <label for="asd">Price</label>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-info hover">Submit</button>
                    </div>
                </div>
            </form>
        </p>
    </div>
@endforeach
</div>
@endsection
@section('scripts')
<script>
    $(function(){
        var divModule = $('#divModule');
        var i = $('#description p').length + 1;
        $('#addModule').on('click', function(){
            console.log(i);
            i++;
            $(`<p>
            <textarea name="description[]" id="description"  rows="4" class="m-t-15 form-control" style="height:auto;border-bottom:1px solid rgba(0,0,0,.25)" placeholder="Details here..."></textarea>
            <input type="text" name="days[]" id="days" class="m-t-15 form-control form-control-line" style="border-bottom:1px solid rgba(0,0,0,.25)" placeholder="Days to do">
            <a href="#" id="removeModule">Remove Module</a>
            </p>`).appendTo(divModule);
            return false;
        });

        $('#divModule').on('click', '#removeModule', function(){
             
            if(i >= 2){
                $(this).parents('p').remove();
                i--;
            }
            return false;
        });
    });
</script>
<script>
    $('#asd').change(function(){
        this.value = parseFloat(this.value).toFixed(2);
    })
</script>
@endsection