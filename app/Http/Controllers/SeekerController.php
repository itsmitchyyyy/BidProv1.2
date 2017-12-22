<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Hash;
//use Illuminate\Support\Facades\Redirect;
use App\User;
class SeekerController extends Controller
{
    public function getRole(){
        $users = User::whereHas('roles', function($q){
            $q->where('name','seeker');
        })->get();

        return view('admin/seekers')->with(array('seekers'=>$users));
    }

    public function seekerData(){
        return view('admin/seekers');
    }

    public function seekerProfile($id){
        $users = User::findOrFail($id);
        
        return view('userprofiles/seeker')->with(array('data'=>$users));
    }

    public function updatePassword(Request $request, $id){
        $messages = [
            'current_password.required' => 'Please enter current password',
        ];
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'current_password' => 'required',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|min:6|same:password',
            ], $messages);
            if($validator->fails()){
                //$id = Auth::id();
                return redirect('/seeker/profile/'.$id)
                    ->withInput(['tab' => 'password'])
                    ->withErrors($validator);
            }else{
                $current_password = Auth::user()->password;
                if(Hash::check($request->current_password, $current_password)){
                    $user_id = $id;
                    $user = User::find($user_id);
                    $user->password = bcrypt($request->password);
                    $user->save();
                    return redirect('/seeker/profile/'.$user_id)
                        ->withInput(['tab' => 'password'])
                        ->with('success','Password updated');
                }else{
                    return redirect('/seeker/profile/'.$id)
                        ->withInput(['tab'=>'password'])
                        ->withErrors(['current_password' => 'Current password is invalid']);
                }
            }
        }
    }

    public function updateProfile(Request $request){
        
    }
}
