<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resume;
use Auth;
class ResumeController extends Controller
{
    public function addWork(Request $request){
        $work_started = $request->work_year_started.'-'.$request->work_month_started.'-'.$request->work_day_started;
        $work_ended = $request->work_year_ended.'-'.$request->work_month_ended.'-'.$request->work_day_ended;
        $work = new Resume();
        $work->user_id = Auth::user()->id;
        $work->work_company = $request->work_company;
        $work->work_position = $request->work_position;
        $work->work_city = $request->work_city;
        $work->work_description = $request->work_description;
        $work->work_started = $work_started;
        $work->work_ended = $work_ended;
        $work->save();
        return back()->with('success','Work Added');
    }

    public function showWork($id){
        $works = Resume::where('user_id', $id)->get();
        return $works;  
    }

    public function addUniversity(Request $request){
        $university_started = $request->attend_year_started.'-'.$request->attend_month_started.'-'.$request->attend_day_started;
        $university_ended =  $request->end_year_started.'-'.$request->end_month_started.'-'.$request->end_day_started;
        $university = new Resume();
        $university->user_id = Auth::user()->id;
        $university->university_school = $request->education_university;
        $university->university_started = $university_started;
        $university->university_ended = $university_ended;
        $university->university_description =  $request->education_university_description;
        $university->university_degree = $request->education_university_degree;
        $university->save();
        return back()->with('success','University Added');
    }

    public function showUniversity($id){
        $university = Resume::where('user_id', $id)->get();
        return $university;
    }

    public function addHighschool(Request $request){
        $highschool_started = $request->hsattend_year_started.'-'.$request->hsattend_month_started.'-'.$request->hsattend_day_started;
        $highschool_ended =  $request->hsend_year_started.'-'.$request->hsend_month_started.'-'.$request->hsend_day_started;
        $highschool = new Resume();
        $highschool->user_id = Auth::user()->id;
        $highschool->highschool_school = $request->education_highschool;
        $highschool->highschool_started = $highschool_started;
        $highschool->highschool_ended = $highschool_ended;
        $highschool->highschool_description =  $request->education_highschool_description;
        $highschool->save();
        return back()->with('success','Highschool Added');
    }

    public function showHighschool($id){
        $highschool = Resume::where('user_id', $id)->get();
        return $highschool;
    }

    public function deleteData(){
        $id = $_POST['id'];
        Resume::find($id)->delete();
    }
}
