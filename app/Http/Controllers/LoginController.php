<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class LoginController extends Controller
{
    public function loginForm(){
        return view('login');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);
        if($validator->fails()){
            return redirect()->route('login')
                ->withErrors($validator);
        }
        $username = $request->username;
        $password = $request->password;
        if(filter_var($username, FILTER_VALIDATE_EMAIL)){
            if(Auth::attempt(['email' => $username, 'password' => $password])){
                if(Auth::user()->status == 1){
                    if($request->user()->hasRoles('admin')){
                        return redirect()->route('admin');
                    }elseif ($request->user()->hasRoles('bidder')) {
                        return redirect()->route('bidder');
                    }elseif ($request->user()->hasRoles('seeker')) {
                        return redirect()->route('seeker');
                    }
                }
               else {
                    return redirect()->route('login')
                        ->withErrors(['error' => 'Your account has been blocked']);
                }
            }
        }elseif (Auth::attempt(['username' => $username, 'password' => $password])) {
            if(Auth::user()->status == 1){
                if($request->user()->hasRoles('admin')){
                    return redirect()->route('admin');
                }elseif ($request->user()->hasRoles('bidder')) {
                    return redirect()->route('bidder');
                }elseif ($request->user()->hasRoles('seeker')) {
                    return redirect()->route('seeker');
                }
            }else{
                return redirect()->route('login')
                        ->withErrors(['error' => 'Your account has been blocked']);
            }
           
        }else {
            return redirect()->route('login')
            ->withErrors(['error' => 'Invalid Credentials']);
        }
    }

    public function logout(Request $request){
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('login');
    }

    public function guard(){
        return Auth::guard();
    }
}
