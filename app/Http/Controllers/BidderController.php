<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
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
   public function bidderProfile($id){
       $users = User::findOrFail($id);

       return view('userprofiles/bidder')->with(array('data'=>$users));
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
        'zip_code' => 'sometimes|nullable|regex:/\b\d{4}\b/'
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
        $user->save(); 
       return redirect('/bidder/profile/'.$id)
            ->withInput(['tab' => 'settings'])
            ->with('success','Profile updated');
        }
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
}
