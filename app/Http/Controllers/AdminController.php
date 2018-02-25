<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Role;
use Carbon\Carbon;
use App\Transaction;
use App\Report;
use DB;
class AdminController extends Controller
{
    public function totalUsers(){
        $users = DB::table('users')
            ->join('role_user','role_user.user_id','=','users.id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->where('roles.name','!=','admin')
            ->count();
        return $users;
    }
    public function newProjects(){
        $projects = DB::table('projects')
            ->whereDate('created_at', '=', Carbon::today()->toDateString())
            ->count();
         return $projects;
    }
    public function totalProjects(){
        $projects = Project::all()->count();
        return $projects;
    }

    public function totalReports(){
        $reports = Report::all()->count();
        return $reports;
    }


    public function monthlyCommision(){
        $commisions = DB::table('transactions')
            ->select(DB::raw('SUM(commission) as monthly_commission, MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at) ASC'))
            ->get();
        echo json_encode($commisions);
    }
    
    public function deactivateUser(){
        $user_id = $_POST['user_id'];
        DB::table('users')
            ->where('id',$user_id)
            ->update(['status' => 0]);
    }
    public function activateUser(){
        $user_id = $_POST['user_id'];
        DB::table('users')
            ->where('id',$user_id)
            ->update(['status' => 1]);
    }

    public function viewUser(){
       $user_id = $_GET['user_id'];
       $users = User::find($user_id);
       echo json_encode($users); 
    }

    public function openProjects(){
        $openProjects = Project::where('status','open')->count();
        $ongoingProjects = Project::where('status','ongoing')->count();
        $doneProjects = Project::where('status','done')->count();
        $totalProjects = Project::all()->count();
        return view('admin/projects',compact('openProjects','ongoingProjects','doneProjects','totalProjects'));
    }
    public function monthlyProjects(){
        $monthlyProjects = DB::table('projects')
            ->select(DB::raw('COUNT(id) as monthly_projects, MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at) ASC'))
            ->get();
        echo json_encode($monthlyProjects);
    }

    public function userSeeker(){
        $seekers = User::whereHas('roles', function($q){
            $q->where('name','seeker');
        })->count();
      return $seekers;
    }
    public function bannedSeekers(){
        $seekers =  User::whereHas('roles', function($q){
            $q->where('name','seeker');
        })->where('status',0)
        ->count();
        return $seekers;
    }
    public function activeSeekers(){
        $seekers =  User::whereHas('roles', function($q){
            $q->where('name','seeker');
        })->where('status',1)
        ->count();
        return $seekers;
    }

    public function userBidder(){
        $bidders =  User::whereHas('roles', function($q){
            $q->where('name','bidder');
        })->count();
      return $bidders;
    }
    public function bannedBidder(){
        $bidders =  User::whereHas('roles', function($q){
            $q->where('name','bidder');
        })->where('status',0)
        ->count();
        return $bidders;
    }
    public function activeBidder(){
        $bidders =  User::whereHas('roles', function($q){
            $q->where('name','bidder');
        })->where('status',1)
        ->count();
        return $bidders;
    }
    
    public function seekerReports($seeker_id){
        $reports = Report::where('seeker_id',$seeker_id)->count();
        return $reports;
    }

    public function bidderReports($bidder_id){
        $reports = Report::where('bidder_id',$bidder_id)->count();
        return $reports;
    }

    public function getBannedBidders(){
        $bidders =  User::whereHas('roles', function($q){
            $q->where('name','bidder');
        })->where('status',0)
        ->get();
        return $bidders;
    }
    public function getBannedSeekers(){
        $seekers =  User::whereHas('roles', function($q){
            $q->where('name','seeker');
        })->where('status',0)
        ->get();
        return $seekers;
    }
}
