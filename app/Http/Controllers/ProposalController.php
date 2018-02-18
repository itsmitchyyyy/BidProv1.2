<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposal;
use App\Module;
use App\Project;
use App\Bid;
use DB;
use Illuminate\Support\Facades\Auth;
class ProposalController extends Controller
{
    public function viewProposals(){
        // $proposal = Proposal::where('bidder_id',Auth::user()->id)->with('projects')->get();
        $proposal = DB::table('proposals')
            ->where('proposals.bidder_id',Auth::user()->id)
            ->join('projects','proposals.project_id','=','projects.id')
            ->join('modules','modules.proposal_id','=','proposals.id')
            ->where('proposals.status',1)
            ->select('*','proposals.id as proposal_id','modules.id as module_id')
            ->get();
        return view('bids/bidder')->with(compact('proposal'));
    }

    public function cancelProposal(Request $request){
        DB::table('proposal_modules')
            ->where('module_id',$request->mod_id)
            ->delete();
        DB::table('module_comments')
            ->where('module_id', $request->mod_id)
            ->delete();
        Module::find($request->mod_id)->delete();
        Proposal::where('id', $request->pr_id)->delete();
        return redirect()->route('bids')->with('success','Bid Cancelled'); 
    }
    public function getModule($proposal_id){
        $module = Module::where('proposal_id', $proposal_id)->pluck('id')->toArray();
        return $module;
    }
}
