<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Bid;
use App\Project;
use App\User;
use App\Proposal;
use DB;
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
            ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id')
            ->get();
        $doing = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','bids.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','doing')
          ->where('bids.seeker_id', $seeker_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id')
          ->get();

          $done = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','bids.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','done')
          ->where('bids.seeker_id', $seeker_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id')
          ->get();
        
          $project = Project::find($project_id);
          $proposal = DB::table('proposals')
            ->join('users','proposals.bidder_id','=','users.id')
            ->where('proposals.id',$proposal_id)
            ->first();
            return view('ongoing/seeker')
            ->with(compact('todo','doing','done','project','proposal'));
    }
    public function proposalModules(){
        $module_id = $_GET['module_id'];
        $modules = DB::table('proposal_modules')
            ->where('proposal_modules.module_id',$module_id)
            ->get();
        return json_encode($modules);
    }
}
