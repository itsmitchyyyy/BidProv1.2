<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class RatingController extends Controller
{

    public function viewUser(){
        $users = User::all();
        return view('ratings/users', compact('users'));
    }
    public function reviewUser($id){
        $user = User::find($id);
        return view('ratings/seeker', compact('user'));
    }
    

    public function postReview(Request $request){
        request()->validate(['rate' => 'required']);
        $user = User::find($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = Auth::user()->id;
        $user->ratings()->save($rating);
        return redirect()->route('rate.show', $request->id);
    }
}
