<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Project;
use App\User;
class ProjectController extends Controller
{
    public function create(Request $request){
        $regex = '/^\d{0,8}(\.\d{1,2})?$/';
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'category' => 'required|not_in:0',
            'cost' => 'required|regex:'.$regex
        ]);
        if($validator->fails()){
            return redirect()->route('seeker')
                ->withInput()
                ->withErrors($validator);
        }

        $projects = new Project();
        $projects->user_id = Auth::id();
        $projects->title = $request->title;
        $projects->details = $request->details;
        $projects->start = $request->start;
        $projects->end = $request->end;
        $projects->category = $request->category;
        $projects->cost = $request->cost;
        $projects->save();

        return redirect()->route('seeker')->with('success','Data added');

    }
    
    public function getProjects(){
        $projects = DB::table('projects')
            ->join('users', 'projects.user_id', '=', 'users.id')
            ->orderBy('projects.id','desc')
            ->select('*','projects.id as project_id')
            ->get();
        
            
        return view('users/seeker')->with(array('projects'=>$projects));
    }
    public function seekerView(){
        return view('users/seeker');
    }
}
