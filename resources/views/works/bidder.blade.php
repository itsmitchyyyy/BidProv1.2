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
    {{ $works }}
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
                <td><a href="">{{ ucfirst($work->title) }}</a></td>
                <td>
                <div class="clearfix">
                    <img src="/{{ $work->avatar }}" alt="avatar" style="width:70px;height:70px" class="gap-right img-thumbnail pull-left">
                    <p><a href="">{{ ucfirst($work->firstname) }} {{ ucfirst($work->lastname) }}</a>
                    <br>
                    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $users->usersReview($work->seeker_id)->userAverageRating }}" data-size="s" disabled>
                    Reviews: {{ $users->usersReview($work->seeker_id)->userSumRating }} Reviews
                    </p>
                </div>
                </td>
                <td><span>&#8369;</span> {{ $work->min }} - <span>&#8369;</span> {{ $work->max }}</td>
                <td>{{ ucfirst($work->status) }}</td>
                <td>
                    <a href="#"><i class="fa fa-eye text-blue" data-toggle="tooltip" title="View" style="font-size:20px"></i></a>
                    <a href="#"><i class="fa fa-trash text-danger p-1" data-toggle="tooltip" title="Delete" style="font-size:20px"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
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
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>
<script>
    $('#input-id').rating();
</script>
@endpush