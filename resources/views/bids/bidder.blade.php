@extends('layouts.bidderapp')
@section('content')
@inject('bids', 'App\Http\Controllers\ProjectController')
@inject('module', 'App\Http\Controllers\ProposalController')
<div class="container-fluid m-t-15">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissable fade show" >
            <button data-dismiss="alert=" class="close"><i class="fa fa-close"></i></button>
            {{ session()->get('success') }}
        </div>
    @endif
    <h3>My Bids</h3>
    <table id="myTable" class="table table-striped table-bordered" width="100%">
        <thead>
        <tr>
            <th>Project</th>
            <th>Bids</th>
            <th>Ends</th>
            <th>Price(PHP)</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($proposal as $propose)

        <tr>
            <td><a href="{{ route('myWorks',['proposal_id' => $propose->id,'bidder_id' => $propose->bidder_id,'project_id' => $propose->project_id]) }}">{{ ucfirst($propose->title) }}</a></td>
            <td><i class="fa fa-trophy"></i> {{ $bids->countBid($propose->project_id) }}</td>
            <td><i class="fa fa-clock-o"></i> {{ Carbon\Carbon::parse($propose->duration)->diffForHumans() }}</td>
            <td><span>&#8369;</span> {{ $propose->min }} - <span>&#8369;</span> {{ $propose->max }}</td>
            <td>
          <a href="{{ route('myWorks',['proposal_id' => $propose->id,'bidder_id' => $propose->bidder_id,'project_id' => $propose->project_id]) }}"><i class="fa fa-eye text-blue" style="font-size:16px" data-toggle="tooltip" title="View"></i></a>
            <a href="#" data-toggle="modal" data-target="#cancelModal{{ $propose->id }}" data-tooltip="true" Title="Cancel"><i class="text-danger fa fa-times"></i></a>
            </td>
           <div class="modal fade" tabindex="-1" role="dialog" id="cancelModal{{ $propose->id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                            <h3>Cancel Bid</h3>
                        </div>
                        <div class="modal-body">
                            <p>
                                Are you sure you want to cancel your bid on this project?
                            </p>
                        </div>
                        <div class="modal-footer">
                        <form action="{{ route('bids') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="mod_id" value="{{ $propose->module_id }}">
                            <input type="hidden" name="pr_id" value="{{ $propose->proposal_id }}">
                            <button type="submit" class="btn btn-info wew">Yes</button>
                            <button type="button" class="btn btn-secondary wew" data-dismiss="modal">No</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $("[data-tooltip='true']").tooltip();
    });
</script>
<script>
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>
@endsection