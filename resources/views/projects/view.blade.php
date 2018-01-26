@extends('layouts.seekerapp')
@push('css')
<style>
.gap-right{
    margin-right:10px;
}
.glyphicon-star:before {
    content: "\f005";  /* this is your text. You can also use UTF-8 character codes as I do here */
    font-family: FontAwesome;
}
.glyphicon-star-empty:before {
    content: "\f005";  /* this is your text. You can also use UTF-8 character codes as I do here */
    font-family: FontAwesome;
}
</style>
@endpush
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
{{ $biddings }}
@inject('controller', 'App\Http\Controllers\ProjectController')
<table class="table table-bordered m-t-15">
<tr class="bg-success">
<th class="text-white w-75">BIDDING(50)</th>
<th class="text-white">REPUTATION</th>
<th class="text-white">BID (PHP)</th>
</tr>
@foreach($biddings as $bidding)
<tr>
<td>
<div class="clearfix">
<a href=""><img src="/{{ $bidding->avatar }}" alt="" style="height:150px;width:150px" class="pull-left gap-right"></a>
<p class="text-muted">
<a href="">{{ $bidding->firstname }} {{ $bidding->lastname }}</a>
<br><small>@foreach($controller->getCreatedAt($bidding->proposal_id) as $date)  {{ Carbon\Carbon::parse($date->created_at)->diffForHumans() }} @endforeach</small>
</p>
</div>
</td>
<td class="">
<input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $controller->getBidder($bidding->bidder_id)->userAverageRating }}" data-size="s" disabled="">
<p class="text-muted">User Reviews: {{ $controller->getBidder($bidding->bidder_id)->userSumRating }} Reviews</p>
</td>
<td class="">
<span>&#8369;</span> {{ $bidding->price }}
<p class="text-muted">in @foreach($controller->getProjectModules($bidding->proposal_id) as $module) {{ $module }} days @endforeach</p>
</td>
</tr>
@endforeach
</table>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/star-rating.js') }}"></script>
<script type="text/javascript">
    $("#input-id").rating();
</script>
@endsection