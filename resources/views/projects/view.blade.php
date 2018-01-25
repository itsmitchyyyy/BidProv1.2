@extends('layouts.seekerapp')
@section('content')
<div class="container-fluid m-t-15">
@foreach($proposals as $proposal)
<h3><b>{{ ucfirst($proposal->title) }}</b></h3>
<div class="card m-t-15">
    <div class="card-block">
        <small><b>Project ID: {{ $proposal->id }} </b></small>
        <h4 class="card-title"><b>Project description</b></h4>
        <p class="card-text" style="max-width:40em;word-wrap:break-word">{{ $proposal->details }}</p>
    </div>
</div>
<div class="card">
    <div class="card-block">
        <div style="border-right:1px solid black; width:4em;" class="pull-left "><p><b>BIDS</b><br>@if($proposals->isEmpty()) 0 @else {{ count($proposal->proposals) }} @endif</p></div>
        <div style="border-right:1px solid black;width:10em;" class="pull-left m-l-10 "><p><b>Avg Bid (PHP)</b><br><span>&#8369;</span>@if($proposal->proposals->isEmpty()) 0 @else {{ number_format($avg,2) }} @endif</p></div>
        <div style="width:20em" class="pull-left m-l-10"><p><b>Project Budget (PHP)</b><br><span>&#8369;</span> {{ $proposal->min }} - <span>&#8369;</span> {{ $proposal->max }}</p></div>
        <div class="pull-right m-r-15"><p><b>{{ Carbon\Carbon::parse($proposal->duration)->diffForHumans() }}</b><h3 class="text-center">@if($proposal->duration > Carbon\Carbon::now()) OPEN @else CLOSED @endif </h3></p></div>
    </div>
</div>
@endforeach
<table class="table table-bordered m-t-15">
<tr class="bg-success">
<th class="text-white w-50">BIDDING(50)</th>
<th class="text-white">REPUTATION</th>
<th class="text-white">BID (PHP)</th>
</tr>
<?php for($i = 1; $i < 51; $i++){?>
<tr>
<td><?php echo $i; ?></td>
<td>test</td>
<td>test</td>
</tr>
<?php } ?>
</table>
</div>
@endsection