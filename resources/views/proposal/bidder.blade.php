@extends('layouts.bidderapp')
@push('css')
<style>
.glyphicon-star:before {
    content: "\f005";  /* this is your text. You can also use UTF-8 character codes as I do here */
    font-family: FontAwesome;
}
.glyphicon-star-empty:before {
    content: "\f005";  /* this is your text. You can also use UTF-8 character codes as I do here */
    font-family: FontAwesome;
}
.gap-right{
    margin-right:10px;
}
</style>
@endpush
@section('content')
<div class="container-fluid m-t-15">
@inject('users', 'App\Http\Controllers\RatingController')
@inject('controller', 'App\Http\Controllers\ProjectController')
@foreach($proposals as $proposal)
<h3><b>{{ ucfirst($proposal->title) }}</b></h3>
<div class="card">
    <div class="card-block">
        <div style="border-right:1px solid black; width:4em;" class="pull-left "><p><b>BIDS</b><br>@if($proposal->proposals->isEmpty()) 0 @else {{ count($proposal->proposals) }} @endif</p></div>
        <div style="border-right:1px solid black;width:10em;" class="pull-left m-l-10 "><p><b>Avg Bid (PHP)</b><br><span>&#8369;</span>@if($proposal->proposals->isEmpty()) 0 @else {{ number_format($avg,2) }} @endif</p></div>
        <div style="width:20em" class="pull-left m-l-10"><p><b>Project Budget (PHP)</b><br><span>&#8369;</span> {{ $proposal->min }} - <span>&#8369;</span> {{ $proposal->max }}</p></div>
        <div class="pull-right m-r-15"><p><b>{{ Carbon\Carbon::parse($proposal->duration)->diffForHumans() }}</b><h3 class="text-center">@if($proposal->duration < Carbon\Carbon::now()) CLOSED @else OPEN @endif</h3></p></div>
    </div>
</div>
<div class="card m-t-15 mb-5">
    <div class="card-block">
        <small><b>Project ID: {{ $proposal->id }} </b></small>
        <h4 class="card-title"><b>Project description</b></h4>
        <p class="card-text" style="max-width:40em;word-wrap:break-word">{{ $proposal->details }}</p>
        <p class="card-text">
        <h4><b>Seeker Review</b></h4>
        <?php $user = $users->usersReview($proposal->user_id) ?>
        <div class="clearfix mb-2">
        <img src="/{{ $user->avatar }}" alt="avatar" class="img-thumbnail m-b-15 pull-left gap-right" style="width:100px;height:100px">
        <p>
        <a href="#">{{ ucfirst($user->firstname) }} {{ ucfirst($user->lastname) }}</a>
        <br>
        <small>{{ $user->email }}</small>
        </p>
        </div>
        <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $user->userAverageRating }}" data-size="s" disabled="">
        </p>
        <div class="pull-right">
        @if($proposal->duration < Carbon\Carbon::now())
        <button disabled class="btn btn-info wew">Bid</button>
        @else
        <a href="{{ route('proposal', ['project_id' => $proposal->id]) }}"><button  class="btn btn-info wew">Bid</button></a>
        @endif
        </div>
    </div>
</div>
<?php $totalbid = $controller->countBid($proposal->id) ?>
@endforeach
<table class="table table-bordered m-t-15" id="myBidding">
<thead>
<tr class="bg-success">
<th class="text-white" style="width:70%">BIDDING({{ $totalbid }})</th>
<th class="text-white">REPUTATION</th>
<th class="text-white">BID (PHP)</th>
</tr>
</thead>
<tbody>
@foreach($biddings as $bidding)
<tr>
<td>
<div class="clearfix">
<a href=""><img src="/{{ $bidding->avatar }}" alt="" style="width:100px;height:100px" class="img-thumbnail pull-left gap-right"></a>
<p class="text-muted">
<a href="">{{ $bidding->firstname }} {{ $bidding->lastname }}</a>
<br><small>@foreach($controller->getCreatedAt($bidding->proposal_id) as $date)  {{ Carbon\Carbon::parse($date->created_at)->diffForHumans() }} @endforeach</small>
</p>
</div>
</td>
<td >
<input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $controller->getBidder($bidding->bidder_id)->userAverageRating }}" data-size="s" disabled="">
<p class="text-muted">User Reviews: {{ $controller->getBidder($bidding->bidder_id)->userSumRating }} Reviews</p>
</td>
<td >
<span>&#8369;</span> {{ $bidding->price }} <br> in {{ $bidding->daysTodo }} days
<p class="text-muted">
       
    </p>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endsection
@section('scripts')
<!-- <script src="{{ asset('js/landing-page/jquery/jquery.min.js') }}"></script> -->
<script src="{{ asset('js/star-rating.js') }}"></script>
<script>
    $('#input-id').rating();
</script>
<script>
    $(function(){
        $('#myBidding').DataTable();
    });
</script>
@endsection