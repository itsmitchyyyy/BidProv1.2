<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use App\Role;
use App\Project;
use Illuminate\Support\Facades\Validator;
class MobileController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);
        if($validator->fails()){
            return redirect()->route('mobile.login')
                ->withErrors($validator);
        }
        $username = $request->username;
        $password = $request->password;
        if(filter_var($username, FILTER_VALIDATE_EMAIL)){
            if(Auth::attempt(['email' => $username, 'password' => $password])){
                if(Auth::user()->status == 1){
                    $user = Auth::user()->toArray();
                   if ($request->user()->hasRoles('bidder')) {
                        return redirect()->route('bidder.home');
                    }elseif ($request->user()->hasRoles('seeker')) {
                        return redirect()->route('seeker.home');
                    }
                }
               else {
                    return redirect()->route('mobile.login')
                        ->withErrors(['error' => 'Your account has been blocked']);
                }
            }
        }elseif (Auth::attempt(['username' => $username, 'password' => $password])) {
            if(Auth::user()->status == 1){
                if ($request->user()->hasRoles('bidder')) {
                    return redirect()->route('bidder.home');
                }elseif ($request->user()->hasRoles('seeker')) {
                    return redirect()->route('seeker.home');
                }
            }else{
                return redirect()->route('mobile.login')
                        ->withErrors(['error' => 'Your account has been blocked']);
            }
           
        }else {
            return redirect()->route('mobile.login')
            ->withErrors(['error' => 'Invalid Credentials']);
        }
    }

    public function seekerHome(){
        return view('mobile/seeker/home');
    }
    public function bidderHome(){
        return view('mobile/bidder/home');
    }

    public function updateBAvatar(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'image_avatar' => 'image',
        ]);
        if($validator->fails()){
            return back()
                ->withErrors($validator);
        }
        if($request->hasFile('image_avatar')){
            $user = User::find($id);
            $file = $request->file('image_avatar');
            $file->move('uploads', $file->getClientOriginalName());
            $image_path = "uploads/". $file->getClientOriginalName();
            $user->avatar = $image_path;
            $user->save();
            return back()
                ->with('success','Profile updated');
        }
    }

    public function getProjects(){
        $projects = Project::where(['user_id' => Auth::user()->id])
            ->whereIn('status',['ongoing','done'])
        ->get();
        return view('mobile/seeker/project')->with(compact('projects')); 
    }

    public function getBProjects(){
        $projects = Project::where('status','open')->get();
        return view('mobile/bidder/project')->with(compact('projects')); 
    }

    public function logout(Request $request){
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('mobile.login');
    }

    public function guard(){
        return Auth::guard();
    }
}
