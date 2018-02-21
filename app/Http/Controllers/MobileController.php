<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use App\Role;
class MobileController extends Controller
{
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $userdata = array(
            'username' => $username,
            'password' => $password
        );
        if(Auth::attempt($userdata)){
            $user = Auth::user();
            $role = DB::table('role_user')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','users.id','=','role_user.user_id')
                ->where('users.id',$user->id)
                ->get();
             echo json_encode(array("data"=>$role));
        }else{
            $error = array(
                'result' => 'Invalid Credentials'
            );
            echo json_encode($error);
        }    
        
    }

    public function userRatings(Request $request){
        $ratings = DB::table('ratings')
                ->where('rateable_id',$request->id)
                ->avg('rating');
        if($ratings == null){
            $rate = array(
                'rating' => 0
            );
        }else{
            $rate = array(
                'rating' => $ratings
            );
        }        
        echo json_encode($rate);
    }

}
