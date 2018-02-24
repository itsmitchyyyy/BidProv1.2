@extends('layouts.bidderapp')
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
        .gap-right{
            margin-right:10px;
        }
    </style>
@endpush
@section('content')
<div class="container-fluid">
    <h3>My Works</h3>
    @inject('users','App\Http\Controllers\RatingController')
    <ul class="nav customtab nav-tabs m-t-15 m-b-30" id="tabMenu" role="tablist">
        <li class="nav-item" role="presentation">
            <a href="#ongoing" class="nav-link active" role="tab" data-toggle="tab">Ongoing Projects</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#done" class="nav-link" role="tab" data-toggle="tab">Done Projects</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="ongoing">
            <h2>Ongoing Projects</h2>
        <table id="myTable">
    <thead>
        <tr>
            <th>Project</th>
            <th>Client</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($works as $work)
            <tr>
                <td><a href="{{ route('myWorks',['proposal_id' => $work->proposal_id,'bidder_id' => $work->bidder_id,'project_id' => $work->project_id]) }}">{{ ucfirst($work->title) }}</a></td>
                <td>
                <div class="clearfix">
                    <img src="/{{ $work->avatar }}" alt="avatar" style="width:70px;height:70px" class="gap-right img-thumbnail pull-left">
                    <p><a href="{{ route('viewBuser',['user_id' => $work->seeker_id]) }}">{{ ucfirst($work->firstname) }} {{ ucfirst($work->lastname) }}</a>
                    <br>
                    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $users->usersReview($work->seeker_id)->userAverageRating }}" data-size="s" disabled>
                    Reviews: {{ $users->usersReview($work->seeker_id)->userSumRating }} Reviews
                    </p>
                </div>
                </td>
                <td><span>&#8369;</span> {{ $work->min }} - <span>&#8369;</span> {{ $work->max }}</td>
                <td>{{ ucfirst($work->status) }}</td>
                <td>
                    <a href="{{ route('myWorks',['proposal_id' => $work->proposal_id,'bidder_id' => $work->bidder_id,'project_id' => $work->project_id]) }}"><i class="fa fa-eye text-blue" data-toggle="tooltip" title="View" style="font-size:20px"></i></a>
                    <!-- <a href="#"><i class="fa fa-trash text-danger p-1" data-toggle="tooltip" title="Delete" style="font-size:20px"></i></a> -->
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        </div>
        <!-- DONE -->
        <div class="tab-pane" id="done">
           <h2>Done Projects</h2>
           <table id="doneTable">
               <thead>
                   <tr>
                   <th>Project</th>
                   <th>Client</th>
                   <th>Price</th>
                   <th>Status</th>
                   <th>Review</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($done as $dones)
                   <tr>
                       <td><strong>{{ ucfirst($dones->title) }}</strong></td>
                       <td>
                           <div class="clearfix">
                               <img src="/{{ $dones->avatar }}" alt="avatar" style="width:70px;height:70px" class="gap-right img-thumbnail pull-left">
                               <p><a href="{{ route('viewBuser',['user_id' => $dones->seeker_id]) }}">{{ ucfirst($dones->firstname) }} {{ ucfirst($dones->lastname)}}</a>
                               <br>
                               <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $users->usersReview($dones->seeker_id)->userAverageRating }}" data-size="s" disabled>
                               Reviews: {{ $users->usersReview($dones->seeker_id)->userSumRating }} Reviews
                               </p>
                           </div>
                       </td>
                       <td>
                           <span>&#8369;</span> {{ $dones->min }} - <span>&#8369;</span> {{ $dones->max }}
                       </td>
                       <td>
                           {{ ucfirst($dones->status) }}(Paid)
                       </td>
                       <td>
                           <a href="{{ route('rate.seeker', ['user_id' => $dones->seeker_id])}}">Add Review</a>
                       </td>
                   </tr>
                   @endforeach
               </tbody>
           </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/star-rating.js') }}"></script>
<script>
    $(document).ready(function(){
        $("[data-tooltip='true']").tooltip();
    });
</script>
<script>
    $(function(){
        $('#doneTable').DataTable();
    });
</script>
<script>
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>
<script>
    $('#input-id').rating();
</script>
@endpush