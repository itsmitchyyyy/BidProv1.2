<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposal;
use App\Project;
use DB;
use Illuminate\Support\Facades\Auth;
class ProposalController extends Controller
{
    public function viewProposals(){
        $proposal = Proposal::where('bidder_id',Auth::user()->id)->with('projects')->get();
        return view('bids/bidder')->with(compact('proposal'));
    }

    public function cancelProposal(Request $request){
       $db =  DB::table('project_modules')
            ->where('proposal_id', $request->pr_id)
            ->delete();
         Proposal::where('id', $request->pr_id)->delete();
        return redirect()->route('bids'); 
    }
}
