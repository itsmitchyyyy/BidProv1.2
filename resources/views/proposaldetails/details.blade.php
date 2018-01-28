@extends('layouts.seekerapp')
@push('css')
<style>
.glyphicon-star:before{
    content: "\f005";
    font-family: FontAwesome;
}
.glyphicon-star-empty:before{
    content: "\f005";
    font-family: FontAwesome;
}
.wrap-content{
    max-width:40em;
    word-wrap:break-word;
}
</style>
@endpush
@section('content')
<div class="container-fluid m-t-15">
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-md-1 col-xs-6 b-r"><strong>BIDS</strong>
                <br><p class="text-muted">Test</p>
                </div>
                <div class="col-md-1 col-xs-6 b-r"><strong>Avg Bid (PHP)</strong>
                <br><p class="text-muted">Test</p>
                </div>
                <div class="col-md-7 col-xs-6"><strong>Project Budget (PHP)</strong>
                <br><p class="text-muted">Test</p>
                </div>
                <div class="col-md-2 col-xs-6"><strong class="pull-right">Days left</strong>
                <br><p class="text-muted m-r-15 pull-right">Test</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card m-t-15">
        <div class="card-block">
            <small class="float-right">Just now</small>
            <h3 class="card-title">Proposal</h3>
            <hr>
            <small><b>Proposal ID: 1</b></small>
            <h4 class="card-title"><b>Proposal Details</b></h4>
            <p class="card-text wrap-content">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit possimus eos, explicabo doloribus unde hic beatae deserunt numquam nam repellat. Atque est nam adipisci obcaecati consequatur tempore consectetur qui minima.
            </p>
            <p class="card-text">
            <h4><b>Bidders Profile</b></h4>
            <div class="clearfix">
            <img src="/uploads/blank.png" alt="avatar" class="img-thumbnail m-b-15 pull-left gap-right" style="width:100px;height:100px">
            <p class="text-muted">
            <a href="">Test</a>
            <br><small>Test</small>
            </p>
            </div>
            <input id="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="2" data-size="s" disabled>
            </p>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/star-rating.js') }}"></script>
<script>
    $('#input-id').rating();
</script>
@endsection