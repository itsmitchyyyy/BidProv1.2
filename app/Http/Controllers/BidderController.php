<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
class BidderController extends Controller
{
    public function getRole(){
        $users = User::whereHas('roles', function($q){
            $q->where('name','bidder');
        })->get();

       return view('admin/developers')->with(array('users'=>$users));
    }
   public function bidderView(){
       return view('admin/developers');
   }

   
}
