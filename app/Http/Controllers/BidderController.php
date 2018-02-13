<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use DB;
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
   public function bidderProfile($id){
       $skill = array();
       $proficiency = array();
        $users = User::findOrFail($id);
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
       
        return view('userprofiles/bidder')
         ->with(array('data'=>$users))
         ->with(compact('skill','proficiency'));
   }

   public function updatePassword(Request $request, $id){
       $messages = ['current_password.required' => 'Please enter current password'];
   
    if(Auth::check()){
        $validator = Validator::make($request->all(),[
            'current_password' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ], $messages);
        if($validator->fails()){
            return redirect('/bidder/profile',$id)
            ->withInput(['tab' => 'password'])
            ->withErrors($validator);
        }else{
            $current = Auth::user()->password;
            if(Hash::check($request->current_password, $current)){
                $user = User::find($id);
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect('/bidder/profile',$id)
                    ->withInput(['tab' => 'password'])
                    ->with('success', 'Password Updated');
            }else{
                return redirect('/bidder/profile'.$id)
                    ->withInput(['tab' => 'password'])
                    ->withErrors(['current_password' => 'Current password is invalid']);
            }
        }
    }
    }

    public function updateProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
        'firstname' => 'required|max:255',
        'lastname' => 'required|max:255',
        'mobile_no' => 'sometimes|nullable|phone:PH,mobile',
        'landline' => 'sometimes|nullable|phone:PH',
        'street_no' => 'sometimes|nullable|max:255',
        'city' => 'sometimes|nullable|max:255',
        'province' => 'sometimes|nullable|max:255',
        'zip_code' => 'sometimes|nullable|regex:/\b\d{4}\b/',
        'paypal' => 'sometimes|nullable|email|string'
        ]);
        if($validator->fails()){
            return redirect('/bidder/profile/'.$id)
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
         $user->paypal = $request->paypal;
         $user->save(); 
       return redirect('/bidder/profile/'.$id)
            ->withInput(['tab' => 'profile'])
            ->with('success','Profile updated');
        }
    }

    public function addSkills(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'skills' => 'required|max:255',
            'proficiency' => 'required_with:skills',    
        ]);
        if($validator->fails()){
            return redirect('/bidder/profile/'.$id)
            ->withInput(['tab' => 'profile'])
            ->withErrors($validator);
        }
        $user = User::find($id);
        $skills = $request->skills;
        $proficiency = $request->proficiency;
        $data = array_merge(['skills' => $skills],['proficiency' => $proficiency]);
        $datas = '';
        foreach(array_combine($data['skills'], $data['proficiency']) as $skill => $prof){
            $datas .= 'skills:'.$skill.", proficiency:".$prof.", ";

        }
        $value = $user->skills;
        $val = $value.$datas;
        $user->skills = $val;
        $user->save();
        return redirect('/bidder/profile/'.$id)
            ->withInput(['tab' => 'profile'])
            ->with('success', 'Profile updated');
    }
    public function updateAvatar(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'avatar' => 'image',
        ]);

        if($validator->fails()){
            return redirect('/bidder/profile/'.$id)
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

                return redirect('/bidder/profile/'.$id);
            }
        }
        
    }
    public function viewWorks(){
        $works = DB::table('bids')
            ->join('users','bids.seeker_id','=','users.id')
            ->join('proposals','proposals.id','=','bids.proposal_id')
            ->join('projects','projects.id','=','proposals.project_id')
            ->where('bids.bidder_id',Auth::user()->id)
            ->get();
        return view('works/bidder')
            ->with(compact('works'));
    }
}
