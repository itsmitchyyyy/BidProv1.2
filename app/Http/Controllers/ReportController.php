<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use DB;
use App\User;
class ReportController extends Controller
{
    public function postReport(Request $request){
        $report = new Report();
        $report->seeker_id  = $request->seeker_id;
        $report->bidder_id = $request->bidder_id;
        $report->message = $request->message;
        $report->save();
        $report_id = $report->id;
        event(new \App\Events\ReportEvent($request->seeker_id,$request->bidder_id,$request->message,$report_id));
    }
    public function getReport(Request $request){
        $seeker = User::find($request->seeker_id)->all();
        $bidder = User::find($request->bidder_id)->all();
        $reports = array(
            'first' => $seeker,
            'second' => $bidder  
        );
        echo json_encode($reports);
    }
}
