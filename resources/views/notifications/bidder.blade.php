@extends('layouts.bidderapp')
@section('content')
<div class="container-fluid m-t-15">
    <div class="list-group">
        <h3>Notications</h3>
        @if($notifications->isEmpty())
        YOU HAVE 0 NOTIFICATIONS
        @else
        @foreach($notifications as $notification)
        <a href="{{ $notification->link }}" style="border-bottom:1px solid rgba(0,0,0,.25)" class="list-group-item list-group-item-action flex-column align-items-start{{ ($notification->statuss ==  'unread') ? ' list-group-item-info': ' list-group-item-light' }}">
            <p class="mb-1">
                <img src="/{{ $notification->avatar }}" alt="avatar" class="img-circle" style="height:50px;width:50px">
                <b>{{ ucwords($notification->name) }}</b>
                {{ $notification->message }}
            </p>
            <div><small class="font-12">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small></div>
        </a>
        @endforeach
        @endif
    </div>
</div>
@endsection