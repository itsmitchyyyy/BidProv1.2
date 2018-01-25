<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
class RegisterController extends Controller
{
    public function registerForm(){
        return view('register');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|min:6|unique:users',
            'password' => 'required|min:6|confirmed',
            'type' => 'required|min:bidder,seeker'
        ]);
        if($validator->fails()){
            return redirect()->route('register')
                ->withInput()
                ->withErrors($validator);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->avatar = 'uploads/blank.png';
        $type = Input::get('type');
        $user->save();
        $user->roles()->attach(Role::where('name', $type)->first());
        Auth::login($user);
        if(Auth::user()->hasRoles('seeker')){
        return redirect('seeker/profile/'.$user->id)
            ->withInput(['tab' => 'settings']);
        }elseif(Auth::user()->hasRoles('bidder')){
            return redirect('bidder/profile/'.$user->id)
            ->withInput(['tab' => 'settings']);
        }
    }
}
