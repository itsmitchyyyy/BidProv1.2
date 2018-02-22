<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use DB;
use App\User;
class ReportController extends Controller
{
    public function postReport(Request $request ){
        $report = new Report();
        $report->seeker_id  = $request->seeker_id;
        $report->bidder_id = $request->bidder_id;
        $report->message = $request->message;
        $report->save();
        $report_id = $report->id;
        event(new \App\Events\ReportEvent($request->seeker_id,$request->bidder_id,$request->message,$report_id));
    }
    public function getReport(){
        $seeker_id = $_POST['seeker_id'];
        $bidder_id = $_POST['bidder_id'];
        $seeker = User::find($seeker_id);
        $bidder = User::find($bidder_id);
        $reports = array(
            'first' => $seeker,
            'second' => $bidder  
        );
        echo json_encode($reports);
    }
}
