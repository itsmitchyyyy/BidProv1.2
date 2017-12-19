<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function seekerProfile(){
        
    }
}
