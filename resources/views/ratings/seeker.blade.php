@extends('layouts.seekerapp')
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
<div class="container mt-5">
    @if(session()->get('success'))
    <div class="alert alert-success alert-dismissable fade show">
        <button class="close" data-dismiss="alert"><span>&times;</span></button>
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <h3>REVIEW USER</h3>
                <div class="panel-body">
                    <form action="{{ route('rate.post') }}" method="POST">
                        {{ csrf_field() }}
                    <div class="card">
                        <div class="container-fliud">
                            <div class="wrapper row">
                                <div class="preview col-md-6">
                                    <div class="preview-pic tab-content">
                                      <div class="tab-pane active" id="pic-1">
                                      @if($user->avatar == null)
                                      <img src="uploads/blank.png" style="width:500px;height:500px"/>
                                      @else
                                      <img src="/{{ $user->avatar }}" style="width:500px;height:500px"/>
                                      @endif
                                      </div>
                                    </div>
                                </div>
                                <div class="details col-md-6">
                                    <h3 class="mt-5">Name: {{ $user->firstname }} {{ $user->lastname }}</h3>
                                    <h3>Email: {{ $user->email }}</h3>
                                    <h3>Contact: @if($user->contact == null) NONE @else {{ $user->contact }}@endif</h3>
                                    <h3>Address: @if($user->address == null) NONE @else {{ $user->address }} @endif</h3>
                                    <h3 class="product-title mt-5">USER REVIEW</h3>
                                    <div class="rating">
                                        <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $user->userAverageRating }}" data-size="xs">
                                        <input type="hidden" name="id" required="" value="{{ $user->id }}">
                                        <span class="review-no">Average Rating: {{ number_format($user->averageRating,0) }}</span>
                                        <br/>
                                        <br>
                                        <textarea name="comment_review" style="height:auto;border:1px solid rgba(0,0,0,.25)" id="comment_review" class="form-control"  rows="4" placeholder="Write a review here"></textarea><br>
                                        <button class="btn btn-success wew">Submit Review</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
     <!--row -->
   <div class="container-fluid m-t-15">
                    <div class="col-md-12 col-lg-12 col-sm-12" >
                        <div class="white-box " style="border:1px solid rgba(0,0,0,.125); border-radius:.25rem">
                            <h3 class="box-title">Review Feed</h3>
                            <hr style="background-color:rgba(0,0,0,.125)">
                            <div class="comment-center">
                                @foreach($reviews as $review)
                                <div class="comment-body" style="border-bottom:1px solid rgba(0,0,0,0.125);">
                                    <div class="user-img"> <img src="/{{ $review->avatar }}" alt="user" class="img-circle"></div>
                                    <div class="mail-contnet">
                                        <h5>{{ ucfirst($review->firstname) }} {{ ucfirst($review->lastname) }}</h5> <span class="mail-desc">{{ $review->comments }}</span><span class="time pull-right">{{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


@endsection
@section('scripts')
<script src="{{ asset('js/landing-page/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/star-rating.js') }}"></script>
<script type="text/javascript">
    $("#input-id").rating();
</script>
<script>

</script>
@endsection