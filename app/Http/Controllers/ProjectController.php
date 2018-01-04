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
            'min' => 'required|regex:'.$regex,
            'max' => 'required|regex:'.$regex
        ]);
        if($validator->fails()){
            return redirect()->route('projects')
                ->withInput()
                ->with('adding_error',5)
                ->withErrors($validator);
        }

        $projects = new Project();
        $projects->user_id = Auth::id();
        $projects->title = $request->title;
        $projects->details = $request->details;
        $projects->start = $request->start;
        $projects->end = $request->end;
        $projects->category = $request->category;
        $projects->min = $request->min;
        $projects->max = $request->max;
        $projects->save();

        return redirect()->route('projects')->with('success','Data added');

    }
    

    public function openProject(Request $request, $id){
        $regex = '/^\d{0,8}(\.\d{1,2})?$/';
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'category' => 'required|not_in:0',
            'min' => 'required|regex:'.$regex,
            'max' => 'required|regex:'.$regex
        ]);
        if($validator->fails()){
            return redirect()->route('projects')
            ->withInput(['tab'=>'closed'])
            ->with('repost_error',$id)
            ->withErrors($validator);
        }
        $projects = Project::findOrFail($id);
        $projects->title = $request->title;
        $projects->details = $request->details;
        $projects->start = $request->start;
        $projects->end = $request->end;
        $projects->category = $request->category;
        $projects->min = $request->min;
        $projects->max = $request->max;
        $projects->status = '1';
        $projects->save();

        return redirect()->route('projects')->with('success','Data Reposted');
    }

    public function recentProjects()
    {
        $projects = DB::table('projects')
            ->where('user_id', '=', Auth::user()->id)
            ->orderByRaw('created_at DESC')
            ->limit(2)
            ->get();

            return view('users/seeker')->with(array('projects'=>$projects));
          
    }

    public function closeProject($id)
    {
        DB::table('projects')
            ->where('id', '=', $id)
            ->update(array('status'=>0));
        
        return redirect()->route('projects')
            ->withInput(['tab'=>'closed'])
            ->with('success','Project closed');
    }

    public function myProjects(){
        $projects = DB::table('projects')
            ->where(['user_id' => Auth::user()->id,
            'status' => '1'])
            ->orderByRaw('created_at DESC')
            ->get();

      $closedprojects = DB::table('projects')
            ->where(['user_id' => Auth::user()->id,
            'status' => '0'])
            ->orderByRaw('created_at DESC')
            ->get();

            return view('projects/seeker')
                ->with(array('projects'=>$projects))->with(array('closedprojects'=>$closedprojects));
    }
    public function getProjects(){
        $projects = DB::table('projects')
            ->join('users', 'projects.user_id', '=', 'users.id')
            ->orderBy('projects.id','desc')
            ->select('*','projects.id as project_id')
            ->get();
        
            
        return view('projects/seeker')->with(array('projects'=>$projects));
    }

    public function getProjectsBidder()
    {
        $projects = DB::table('projects')
            ->join('users', 'projects.user_id', '=', 'users.id')
            ->orderBy('projects.id','desc')
            ->select('*','projects.id as project_id')
            ->get();

            return view('users/bidder')->with(array('projects'=>$projects));
    }

    public function updateProject(Request $request, $id)
    {
        
        $project = Project::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'titles' => 'required|max:255',
            'detailss' => 'required|max:255',
            'categorys' => 'required|not_in:--'
        ]);
        if($validator->fails()){
            return redirect()->route('projects')
                ->withInput()
                ->with('error_code', $id)
                ->withErrors($validator);
        }

        $project->title = $request->titles;
        $project->details = $request->detailss;
        $project->category = $request->categorys;
        $project->save();

        return redirect('seeker/projects')
            ->with('success' , 'Project updated');

    }

    /*public function closedProjects()
    {
        $projects = DB::table('projects')
            ->where(['user_id' => Auth::user()->id,
            'status' => '0'])
            ->orderByRaw('created_at DESC')
            ->get();

            return view('users/seeker')->with(array('closedprojects'=>$projects));
    }*/

    public function deleteProject($id)
    {
        Project::find($id)->delete();
        return redirect()->route('projects')
            ->with('success', 'Project deleted');
    }

    public function seekerView(){
        return view('users/seeker');
    }
}
