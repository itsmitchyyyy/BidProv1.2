<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use DB;
use App\User;
class ReportController extends Controller
{
    public function postReport(){
        $seeker_id =  $_POST['seeker_id'];
        $bidder_id =  $_POST['bidder_id'];
        $message =  $_POST['message'];
        $report = new Report();
        $report->seeker_id  = $seeker_id;
        $report->bidder_id = $bidder_id;
        $report->message = $message;
        $report->save();
        $report_id = $report->id;
        event(new \App\Events\ReportEvent($seeker_id,$bidder_id,$message,$report_id));
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

    public function getReports(){
        $reports = Report::all();
        echo json_encode($reports);
    }
    
    public function updateReport(){
        $report_id = $_POST['report_id'];
        DB::table('reports')
            ->where('id',$report_id)
            ->update(['status' => 'confirm']);
        echo 'OK';
    }
}
