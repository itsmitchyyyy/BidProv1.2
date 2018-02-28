<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
//use Intervention\Image\Facades\Image;
use Hash;
use Image;
use DB;
use App\Project;
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

    public function updateProfile(Request $request, $id){
     // $user =  User::find($id)->update($request->all());
     $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|unique:users,email,'.$id.',id',
        'firstname' => 'required|max:255',
        'lastname' => 'required|max:255',
        'mobile_no' => 'sometimes|nullable|phone:PH,mobile',
        'landline' => 'sometimes|nullable|phone:PH',
        'street_no' => 'sometimes|nullable|max:255',
        'city' => 'sometimes|nullable|max:255',
        'province' => 'sometimes|nullable|max:255',
        'zip_code' => 'sometimes|nullable|regex:/\b\d{4}\b/'
     ]);
     if($validator->fails()){
         return redirect('/seeker/profile/'.$id)
            ->withInput(['tab' => 'settings'])
            ->withErrors($validator);
     }else{
        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        $user->landline = $request->landline;
        $user->street_no = $request->street_no;
        $user->city = $request->city;
        $user->province = $request->province;
        $user->zip_code = $request->zip_code;
        $user->save(); 
       return redirect('/seeker/profile/'.$id)
            ->withInput(['tab' => 'settings'])
            ->with('success','Profile updated');
        }
        }

    public function updateAvatar(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'avatar' => 'image',
        ]);
        if($validator->fails()){
           
            return redirect('/seeker/profile/'.$id)
                ->withErrors($validator);
           
            }else{
            if($request->hasFile('avatar')){
                $user = User::find($id);
                $file = $request->file('avatar');
                $file->move('uploads', $file->getClientOriginalName());
                $image_path = "uploads/". $file->getClientOriginalName();
               // Image::make($file->getRealPath())->resize(225,225)->save($image_path);
                //$image = Image::make(sprintf('resize/%s', $file->getClientOriginalName()))-resize(225,225)->save();
                $user->avatar = $image_path;
                $user->save();

                return redirect('/seeker/profile/'.$id);
            }
        }
    }

    public function viewUser($id){
        $skill = array();
       $proficiency = array();
        $user = User::find($id);
        $projects = DB::table('projects')
            ->join('proposals','projects.id','=','proposals.project_id')
            ->join('users','users.id','=','projects.user_id')
            ->where(['proposals.status' => 0, 'proposals.bidder_id' => $id])
            ->get();
            $skiller  = User::find($id);
        $skills[] = $skiller->skills;
            // dd($skills);
            foreach($skills as $index => $value){
                if(strpos($value,":") !== false){
                    $data = explode(",",$value);
                    foreach($data as $val){
                        if(strpos($val,"skills") !== false){
                            $check = explode(":",$val);
                            $skill[] = $check[1];
                        }
                        if(strpos($val,"proficiency") !== false){
                            $get = explode(":",$val);
                            $proficiency[] =  $get[1];
                        }
                    }
                }
            }
        return view('view/seeker')
            ->with(compact('user','projects','skill','proficiency'));
    }

    public function countProjects($status){
        $count = Project::where(['user_id' => Auth::user()->id, 'status' => $status])
            ->count();
        return $count;
    }
    
    public function requestRefund(){
        $user_id = $_POST['user_id'];
        $project_id = $_POST['project_id'];
        DB::table('presentation_reports')
            ->where([
                'seeker_id' => $user_id, 
                'project_id' => $project_id
                ])
            ->update([
                'seeker_status' => 2
            ]);
    }
}
