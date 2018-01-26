<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use DB;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    //
    public function viewNotification(){
        $notifications = Notification::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('notifications/seeker')->with(compact('notifications'));
    }
    public function navNotification(){
        $notifications = Notification::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return $notifications;
    }
    public function countNotification(){
        $notifications = Notification::where(['user_id' => Auth::user()->id, 'statuss' => 'unread'])->count();
        return $notifications;
    }
}
