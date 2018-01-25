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
</style>
@endpush
@section('content')
<div class="container-fluid m-t-15">

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
<div class="card m-t-15">
    <div class="card-block">
        <small><b>Project ID: {{ $proposal->id }} </b></small>
        <h4 class="card-title"><b>Project description</b></h4>
        <p class="card-text" style="max-width:40em;word-wrap:break-word">{{ $proposal->details }}</p>
        <p class="card-text">
        <h4><b>Seeker Review</b></h4>
        <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="2" data-size="s" disabled="">
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
@section('scripts')
<script src="{{ asset('js/landing-page/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/star-rating.js') }}"></script>
<script>
    $('#input-id').rating();
</script>
@endsection