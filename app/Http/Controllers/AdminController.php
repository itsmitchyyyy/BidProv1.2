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



}
