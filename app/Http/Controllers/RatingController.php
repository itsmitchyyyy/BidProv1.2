<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
class RatingController extends Controller
{

    public function usersReview($id){
        $users = User::find($id);
        return $users;
    }
    public function reviewUser($id){
        $user = User::find($id);
        $reviews = DB::table('ratings')
        ->join('users', 'users.id','=','ratings.user_id')
        ->where('rateable_id', $id)
        ->select('*','ratings.id as rating_id')
        ->get();
        return view('ratings/seeker', compact('user','reviews'));
    }
    
    public function reviewBUser($id){
        $user = User::find($id);
        $reviews = DB::table('ratings')
            ->join('users','users.id','=','ratings.user_id')
            ->where('rateable_id', $id)
            ->select('*','ratings.id as rating_id')
            ->get();
        return view('ratings/bidder', compact('user','reviews'));
    }

   

    public function postReview(Request $request){
        request()->validate(['rate' => 'required']);
        $user = User::find($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = Auth::user()->id;
        $rating->comments = $request->comment_review;
        $user->ratings()->save($rating);
        return redirect()->route('projects', $request->id)->with('success','Review submitted');
    }
    public function postBReview(Request $request){
        request()->validate(['rate' => 'required']);
        $user = User::find($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = Auth::user()->id;
        $rating->comments = $request->comment_review;
        $user->ratings()->save($rating);
        return redirect()->route('bidder', $request->id)->with('success','Review submitted');
    }

    public function checkReview($user_id, $rateable_id){
        $ratings = DB::table('ratings')
            ->where('user_id', $user_id)
            ->where('rateable_id',$rateable_id)
            ->first();
        return $ratings;
    }

    public function updateComment(){
        $rating_id = $_POST['rating_id'];
        $rating_comment = $_POST['rating_comment'];
        DB::table('ratings')
            ->where('id', $rating_id)
            ->update(['comments' => $rating_comment]);
    }
}
