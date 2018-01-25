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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">

                    <table class="table table-bordered">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th width="400px">Star</th>
                            <th width="100px">View</th>
                        </tr>
                        @if($users->count())
                            @foreach($users as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->name }}</td>
                                <td>
                                    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $user->userAverageRating }}" data-size="xs" disabled="">
                                </td>
                                <td>
                                    <a href="{{ route('rate.show', ['id' => $post->id]) }}" class="btn btn-primary btn-sm">View</a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </table>

                </div>
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
@endsection