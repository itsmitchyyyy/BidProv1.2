<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Bid;
use App\Project;
use App\User;
use App\Proposal;
use Session;
use DB;
use DateTimeZone;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class ModuleController extends Controller
{
    public function getModule($proposal_id,$seeker_id,$project_id)
    {
        $todo = DB::table('bids')
            ->join('proposals','bids.proposal_id','=','proposals.id')
            ->join('modules','modules.proposal_id','=','proposals.id')
            ->where('modules.status','todo')
            ->where('bids.seeker_id', $seeker_id)
            ->where('bids.proposal_id',$proposal_id)
            ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
            ->get();
        $doing = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','bids.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','doing')
          ->where('bids.seeker_id', $seeker_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
          ->get();

          $done = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','bids.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','done')
          ->where('bids.seeker_id', $seeker_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
          ->get();
        
          $project = Project::find($project_id);
          $proposal = DB::table('proposals')
            ->join('users','proposals.bidder_id','=','users.id')
            ->where('proposals.id',$proposal_id)
            ->first();
            return view('ongoing/seeker')
            ->with(compact('todo','doing','done','project','proposal'));
    }

    public function biddergetModule($proposal_id,$bidder_id,$project_id)
    {
        $todo = DB::table('bids')
            ->join('proposals','bids.proposal_id','=','proposals.id')
            ->join('modules','modules.proposal_id','=','proposals.id')
            ->where('modules.status','todo')
            ->where('bids.bidder_id', $bidder_id)
            ->where('bids.proposal_id',$proposal_id)
            ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
            ->get();
        $doing = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','bids.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','doing')
          ->where('bids.bidder_id', $bidder_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
          ->get();

          $done = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','bids.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','done')
          ->where('bids.bidder_id', $bidder_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
          ->get();
        
          $project = DB::table('projects')
            ->join('users','projects.user_id','=','users.id')
            ->first();
          $proposal = DB::table('proposals')
            ->join('users','proposals.bidder_id','=','users.id')
            ->where('proposals.id',$proposal_id)
            ->first();
            return view('ongoing/bidder')
            ->with(compact('todo','doing','done','project','proposal'));
    }
    public function proposalModules(){
        $module_id = $_GET['module_id'];
        $modules = DB::table('proposal_modules')
            ->where('proposal_modules.module_id',$module_id)
            ->get();
        return json_encode($modules);
    }
    // SEEKer
    public function addComment(Request $request){
        $message = ['required' => 'The comment field must not be empty'];
        $validator = Validator::make($request->all(),[
            'progress_comment' => 'required|max:255',
        ], $message);
        if($validator->fails()){
            return redirect()
                ->route('acceptedBid',[$request->comment_proposal,Auth::user()->id,$request->comment_project])
                ->withErrors($validator);
        }
        $ok = DB::table('module_comments')
            ->insert([
                'user_id' => Auth::user()->id,
                'module_id' => $request->comment_module,
                'message' => $request->progress_comment,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Manila')),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Manila'))
            ]); 
             return redirect()
            ->route('acceptedBid',[$request->comment_proposal,Auth::user()->id,$request->comment_project])
            ->with('success','Comment added');
     }
    //  BIDDEr
    public function addCommentBidder(Request $request){
        $message = ['required' => 'The comment field must not be empty'];
        $validator = Validator::make($request->all(),[
            'progress_comment' => 'required|max:255',
        ], $message);
        if($validator->fails()){
            return redirect()
                ->route('myWorks',[$request->comment_proposal,Auth::user()->id,$request->comment_project])
                ->withErrors($validator);
        }
        $ok = DB::table('module_comments')
            ->insert([
                'user_id' => Auth::user()->id,
                'module_id' => $request->comment_module,
                'message' => $request->progress_comment,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Manila')),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Manila'))
            ]); 
             return redirect()
            ->route('myWorks',[$request->comment_proposal,Auth::user()->id,$request->comment_project])
            ->with('success','Comment added');
     }
    //  
     public function moduleComments(){
         $module_id = $_GET['module_id'];
         $comment = DB::table('module_comments')
            ->join('users','users.id','=','module_comments.user_id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','roles.id','=','role_user.role_id')
            ->select('*','roles.name as role_type', 'module_comments.created_at as comment_date')
            ->where('module_id',$module_id)
            ->orderByRaw('module_comments.id DESC')
            ->take(5)
            ->get();
          $comments = $comment->reverse()->values();
          return json_encode($comments);
     }

     public function updateModules(Request $request){
        $module_id = $_POST['module_id'];
        $module_status = $_POST['module_status'];
        DB::table('modules')
            ->where('id',$module_id)
            ->update([
                'status' => $module_status
            ]);
        echo 'ok';
     }

    //  public function divide(){
    //      $count = '100';
    //      $sum = $count/4;
    //      dd($sum);
    //  }
}
