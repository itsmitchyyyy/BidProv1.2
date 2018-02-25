<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Proposal;
use App\Module;
use Carbon\Carbon;
use DateTimeZone;
use App\Project;
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
        $skill_list = array(
            'PHP',
            'AngularJS',
            'ReactJS',
            'Ionic',
            'Java',
            'Javascript',
            'JQuery',
            'CSS3',
            'HTML5',
            'Laravel',
            'Codeigniter',
            'TypeScript',
            'Python',
            'Elixer',
            'Rust',
            'Go',
            'Ruby on Rails',
            'Swift',
            'SQL',
            'C#',
            'C++',
            'C'
        );
        foreach(array_combine($request->skills, $request->proficiency) as $rskills => $rproficiency){
            if($rproficiency == '%'){
                return back()
                    ->withInput(['tab' => 'profile'])
                    ->with('error','Proficiency error');
                break;
            }
            if($rskills == '' || !in_array($rskills,$skill_list)){
                return back()
                    ->withInput(['tab' => 'profile'])
                    ->with('error','Language error');
                break;
            }
            
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
            ->where('bids.status','ongoing')
            ->get();
        $done = DB::table('bids')
        ->join('users','bids.seeker_id','=','users.id')
        ->join('proposals','proposals.id','=','bids.proposal_id')
        ->join('projects','projects.id','=','proposals.project_id')
        ->where('bids.bidder_id',Auth::user()->id)
        ->where('bids.status','done')
        ->get();
        return view('works/bidder')
            ->with(compact('works','done'));
    }

    public function viewUser($id){
        $user = User::find($id);
        $projects = DB::table('projects')
            ->join('proposals','projects.id','=','proposals.project_id')
            ->join('users','users.id','=','projects.user_id')
            ->where(['proposals.status' => 0, 'proposals.bidder_id' => $id])
            ->get();
        return view('view/bidder')
            ->with(compact('user','projects'));
    }

    public function showProposals($id,$proposal_id){
        $avg = Proposal::where('project_id' , $id)->avg('price');
        // $proposals = Project::where(['id' => $id, 'status' => 'open'])->with('proposals')->get();
        $proposals = DB::table('projects')
            ->join('proposals','projects.id','=','proposals.project_id')
            ->where('proposals.id', $proposal_id)
            ->get();
        $count_bid = Proposal::where('project_id', $id)->count();
        $biddings = DB::table('proposals')
            ->join('users', 'users.id', '=', 'proposals.bidder_id')
            ->select('*', 'proposals.id as proposal_id')
            ->orderByRaw('proposals.created_at DESC')
            ->get();

        $proposal_details = Proposal::find($proposal_id);
        $module_details = Module::where('proposal_id', $proposal_id)->get();
        return view('bids/modules')->with(compact('proposals','avg','module_details','proposal_details','count_bid'));
    }

    public function showProposalModules($module_id){
        $proposal_modules = DB::table('proposal_modules')
            ->where('module_id',$module_id)
            ->get();
        return $proposal_modules;
    }
    public function getModules($proposal_id){
        $module = Module::find($proposal_id);
        return $module;
    }
    public function updateProposal(Request $request,$proposal_id,$project_id){
        $regex = '/^\d{0,8}(\.\d{1,2})?$/';
        $validator = Validator::make($request->all(),[
            'proposal_price' => 'required|regex:'.$regex,
            'module_name' => 'required',
            'module_description' => 'required',
            'proposal_days' => 'required'
        ]);
        if($validator->fails()){
            return back()
                ->withInput()
                ->withErrors($validator);
        }
        $proposal = Proposal::find($proposal_id);
        $proposal->price = $request->proposal_price;
        $proposal->daysTodo = $request->proposal_days;
        $proposal->save();
        // $module_description = array_chunk($request->module_description,4,true);
        $module_description = $request->module_description;
        $module_id = $request->module_id;
        $module_name = $request->module_name;
        $proposal_moduleID = $request->proposal_moduleID;
        $last_module = Module::all()->pluck('id')->toArray();
        $last_proposal_module = DB::table('proposal_modules')
            ->pluck('id')
            ->toArray();
        $id = array();
        foreach(array_combine($module_id, $module_name) as $id_module => $name_module){
            if(in_array($id_module,$last_module)){
                 DB::table('modules')
                    ->where('id', $id_module)
                    ->update([
                        'proposal_id' => $proposal_id,
                        'module_name' => $name_module,
                        'updated_at' => Carbon::now(new DateTimeZone('Asia/Manila'))
                    ]);
            }else{
                 DB::table('modules')
                        ->insertGetId([
                            'proposal_id' => $proposal_id,
                            'module_name' => $name_module,
                            'created_at' => Carbon::now(new DateTimeZone('Asia/Manila')),
                            'updated_at' => Carbon::now(new DateTimeZone('Asia/Manila'))
                        ]);
            }
        }
     
        foreach(array_combine($proposal_moduleID, $module_description) as $module_proposalID => $description_module){
                $id = Module::all()->last()->id;
                echo in_array($module_proposalID,$last_proposal_module);
               if(in_array($module_proposalID, $last_proposal_module)){
                DB::table('proposal_modules')
                    ->where('id', $module_proposalID)
                    ->update([
                        'description' => $description_module,
                        'updated_at' => Carbon::now(new DateTimeZone('Asia/Manila'))
                ]);
            }else{
                DB::table('proposal_modules')
                ->insert([
                    'module_id' => $id,
                    'description' => $description_module,
                    'status' => 'todo',
                    'created_at' => Carbon::now(new DateTimeZone('Asia/Manila')),
                    'updated_at' => Carbon::now(new DateTimeZone('Asia/Manila'))
                ]);
            }
        }
        return redirect()
        ->route('bids')
        ->with('success','Module updated successfully');
    }
}
