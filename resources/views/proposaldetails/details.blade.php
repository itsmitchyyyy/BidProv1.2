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
.wrap-skill{
    max-width:10em;
    word-wrap:break-word;
}
</style>
@endpush
@section('content')
<div class="container-fluid m-t-15">
@inject('controller', 'App\Http\Controllers\ProjectController')
<h3><b>{{ ucfirst($projects->title) }}</b></h3>
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-md-1 col-xs-6 b-r"><strong>BIDS</strong>
                <br><p class="text-muted">@if($projects == null) 0 @else {{ count($projects->proposals) }} @endif</p>
                </div>
                <div class="col-md-2 col-xs-6 b-r"><strong>Avg Bid (PHP)</strong>
                <br><p class="text-muted"><span>&#8369;</span>@if($projects == null) 0 @else {{ number_format($avg,2) }} @endif</p>
                </div>
                <div class="col-md-6 col-xs-6"><strong>Project Budget (PHP)</strong>
                <br><p class="text-muted"><span>&#8369;</span> {{ $projects->min }} - <span>&#8369;</span> {{ $projects->max }} </p>
                </div>
                <div class="col-md-2 col-xs-6"><strong class="pull-right">{{ Carbon\Carbon::parse($projects->duration)->diffForHumans() }}</strong>
                <br><h3><p class="font-bold text-muted m-r-40 pull-right">@if(Carbon\Carbon::parse($projects->duration) > Carbon\Carbon::now()) OPEN @else CLOSED @endif </p></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card m-t-15 mb-5">
        <div class="card-block">
            <small class="float-right">{{ Carbon\Carbon::parse($modules[0]->created_at)->diffForHumans() }}</small>
            <h3 class="card-title">Proposal</h3>
            <hr>
            <small><b>Proposal ID: {{ $modules[0]->proposal_id }}</b></small>
            <h4 class="card-title"><b>Proposal Details</b></h4>
            <p class="card-text wrap-content">
           
            @foreach($modules as $key => $module)
            Module name: {{ ucfirst($module->module_name) }}<br>
            <a href="" data-toggle="collapse" data-target="#dataCollapse{{$key}}"><small>View Details</small></a><br>
            <div class="collapse" id="dataCollapse{{$key}}">
                Details:<br>
                @foreach($controller->getProjectModules($module->id) as $proposal_modules)
                    {{ $proposal_modules }}<br>
                @endforeach
                </div>
            @endforeach
                <br>
            Price: <span>&#8369;</span>{{ $proposals->price }}<br>
            in {{ $proposals->daysTodo }} days
            </p>
            <p class="card-text">
            <h4><b>Bidders Profile</b></h4>
            <div class="clearfix">
            <img src="/{{ $user->avatar }}" alt="avatar" class="img-thumbnail m-b-15 pull-left gap-right" style="width:100px;height:100px">
            <p class="text-muted">
            <a href="">{{ ucfirst($user->firstname) }} {{ ucfirst($user->lastname) }}</a>
            <br><small>{{ $user->email }}</small><br>
            <small>Skills</small>
            <?php $data = array_slice($skill, 0 ,2) ?>
            @foreach($data as $key =>  $skills)
                @if($key == 0 )
                   <small>{{ $skills }},</small>
                @else
                <small>{{ $skills }}</small>
                @endif
            @endforeach
            </p>
            </div>
            <input id="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $user->userAverageRating }}" data-size="s" disabled>
            </p>
            <div class="pull-right">
                <a href="#" data-toggle="modal" data-target="#acceptBid"><button class="btn btn-info wew">Award</button></a>
            </div>
        </div>
    </div>
    <!-- MODAL -->
        <div class="modal fade" id="acceptBid">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal"><span>&times;</span></button>
                        <h3>Award Project</h3>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <h2>Are you sure?</h2>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary wew" data-dismiss="modal">Cancel</button>
                        <a href="{{ route('acceptBid',['seeker_id' => Auth::user()->id, 'bidder_id' => $user->id, 'proposal_id' => $modules[0]->proposal_id, 'project_id' => $projects->id]) }}"><button class="btn btn-info wew">Submit</button></a>
                    </div>
                </div>
            </div>
        </div>
    <!-- END MODAL -->
    <table class="table table-bordered m-t-15" id="myBidding">
        <thead>
        <tr class="bg-success">
            <th class="text-white" style="width:50%">BIDDING</th>
            <th class="text-white">REPUTATION</th>
            <th class="text-white">BID (PHP)</th>
            <th class="text-white">ACTION</th>
        </tr>    
        </thead>
        <tbody>
        @foreach($biddings as $bidding)
            <tr>
                <td>
                    <div class="clearfix">
                        <img src="/{{ $bidding->avatar }}" alt="avatar" class="img-thumbnail m-b-15 pull-left gap-right" style="width:100px;height:100px">
                        <p class="text-muted">
                        <a href="">{{ $bidding->firstname }} {{ $bidding->lastname }}</a>
                        <br><small>{{ Carbon\Carbon::parse($bidding->proposal_created_at)->diffForHumans() }}</small>
                        </p>
                    </div>
                </td>
                <td>
                    <input  name="input-1" id="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $controller->getBidder($bidding->bidder_id)->userAverageRating }}" data-size="s" disabled>
                    <p class="text-muted">
                        User Reviews {{ $controller->getBidder($bidding->bidder_id)->userSumRating }} Reviews
                    </p>
                </td>
                <td>
                    <span>&#8369;</span> {{ $bidding->price }}
                    <p class="text-muted">
                            in {{ $bidding->daysTodo    }} days
                    </p>
                </td>
                <td>
        <a href="{{ route('viewBids', ['project_id' => $bidding->project_id, 'user_id' => $bidding->bidder_id, 'proposal_id' => $bidding->proposal_id]) }}" data-toggle="tooltip" title="Award" class="gap-right"><i class="fa fa-trophy" style="font-size:24px"></i></a>
</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
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