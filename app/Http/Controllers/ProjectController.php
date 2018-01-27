<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use URL;
use Session;
use Redirect;
use DB;
use App\Project;
use App\User;
use App\Proposal;
// Paypal
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
class ProjectController extends Controller
{
    private $_api_context;

    public function __construct(){
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

// SEEKER
    public function create(Request $request){
        
        $regex = '/^\d{0,8}(\.\d{1,2})?$/';
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'type' => 'not_in:0',
            'os' => 'not_in:0',
            'category' => 'required|not_in:0',
            'min' => 'required|regex:'.$regex,
            'max' => 'required|regex:'.$regex
        ]);
        if($validator->fails()){
            return redirect()->route('projects')
                ->withInput()
                ->with('adding_error',5)
                ->withErrors($validator);
        }
        $current = Carbon::now();
        $projects = new Project();
        $projects->user_id = Auth::id();
        $projects->title = $request->title;
        $projects->details = $request->details;
        $projects->type = $request->type; 
        $projects->os = $request->os;
        $projects->category = $request->category;
        $projects->min = $request->min;
        $projects->max = $request->max;
        $projects->duration = $current->addDays(7);
        $projects->save();

        return redirect()->route('projects')->with('success','Data added');

    }
    

    public function openProject(Request $request, $id){
        $regex = '/^\d{0,8}(\.\d{1,2})?$/';
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'details' => 'required|string|max:255',
           // 'start' => 'required|date',
            //'end' => 'required|date',
            'category' => 'required|not_in:0',
            'min' => 'required|regex:'.$regex,
            'max' => 'required|regex:'.$regex
        ]);
        if($validator->fails()){
            return redirect()->route('projects')
            ->withInput(['tab'=>'closed'])
            ->with('repost_error',$id)
            ->withErrors($validator);
        }
        $projects = Project::findOrFail($id);
        $projects->title = $request->title;
        $projects->details = $request->details;
       // $projects->start = $request->start;
        //$projects->end = $request->end;
        $projects->category = $request->category;
        $projects->min = $request->min;
        $projects->max = $request->max;
        $projects->status = 'open';
        $projects->save();

        return redirect()->route('projects')->with('success','Data Reposted');
    }

    public function recentProjects()
    {
        $projects = DB::table('projects')
            ->where('user_id', '=', Auth::user()->id)
            ->orderByRaw('created_at DESC')
            ->limit(2)
            ->get();

            return view('users/seeker')->with(array('projects'=>$projects));
          
    }

    public function closeProject($id)
    {
        DB::table('projects')
            ->where('id', '=', $id)
            ->update(array('status'=>'closed'));
        
        return redirect()->route('projects')
            ->withInput(['tab'=>'closed'])
            ->with('success','Project closed');
    }

    public function getMyProject($id){
        $avg = Proposal::where('project_id', $id)->avg('price');
        $proposals = Project::where(['id' => $id, 'status' => 'open'])->with('proposals')->get();
        $biddings = DB::table('proposals')
            ->join('users', 'users.id', '=', 'proposals.bidder_id')
            ->select('*', 'proposals.id as proposal_id')
            ->orderByRaw('proposals.created_at DESC')
            ->get();
           return view('projects/view')->with(compact('proposals','avg','biddings'));
    }
    public function getBidder($id){
        $user = User::find($id);
        return $user;
    }

    public function getProjectModules($id){
        $modules = DB::table('project_modules')
            ->where('proposal_id', $id)
            ->pluck('daysTodo');
        return $modules;
    }
    public function getCreatedAt($id){
        $created_at = DB::table('proposals')
            ->where('id', $id)->get(['created_at']);
        return $created_at;
    }

    public function getProposal($id){
        $proposal = Proposal::where('project_id', $id)->count();
        return $proposal;
    }
    public function getPrice($id){
        $highest = Proposal::where('project_id', $id)->max('price');
        return $highest;
    }
    public function myProjects(){
        $projects = DB::table('projects')
            ->where(['user_id' => Auth::user()->id,
            'status' => 'open'])
            ->orderByRaw('created_at DESC')
            ->get(); 
            
            

      $closedprojects = DB::table('projects')
            ->where(['user_id' => Auth::user()->id,
            'status' => 'closed'])
            ->orderByRaw('created_at DESC')
            ->get();
            return view('projects/seeker')
                ->with(array('projects'=>$projects))->with(array('closedprojects'=>$closedprojects));
    }
    public function getProjects(){
        $projects = DB::table('projects')
            ->join('users', 'projects.user_id', '=', 'users.id')
            ->orderBy('projects.id','desc')
            ->select('*','projects.id as project_id')
            ->get();
        
            
        return view('projects/seeker')->with(array('projects'=>$projects));
    }

    public function updateProject(Request $request, $id)
    {
        
        $project = Project::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'titles' => 'required|max:255',
            'detailss' => 'required|max:255',
            'categorys' => 'required|not_in:--'
        ]);
        if($validator->fails()){
            return redirect()->route('projects')
                ->withInput()
                ->with('error_code', $id)
                ->withErrors($validator);
        }

        $project->title = $request->titles;
        $project->details = $request->detailss;
        $project->category = $request->categorys;
        $project->save();

        return redirect('seeker/projects')
            ->with('success' , 'Project updated');

    }

    

    public function deleteProject()
    {
        $item_name = Session::get('project_name');
        Session::forget('project_name');
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($item_name)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice('4');
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal('4');
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Delete project');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('projects.status'))
            ->setCancelUrl(URL::route('projects.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try{
            $payment->create($this->_api_context);
        }catch(\Paypal\Exception\PPConnectionException $e){
            if(\Config::get('app.debug')){
                \Session::put('error', 'Connection Timeout');
                return Redirect::route('projects');
            }else{
                \Session::put('error', 'An error occured');
                return Redirect::route('projects');
            }
        }
        foreach($payment->getLinks() as $link){
            if($link->getRel() == 'approval_url'){
                $redirect_url = $link->getHref();
                break;
            }
        }
        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)){
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occured');
        return Redirect::route('projects');
    }

    public function paymentStatus(){
        $project_id = Session::get('project_id');
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
        Session::forget('project_id');
        if(empty(Input::get('PayerID')) || empty(Input::get('token'))){
            \Session::put('error', 'Payment faileded');
            return Redirect::route('projects');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if($result->getState() == 'approved'){
             Project::find($project_id)->delete();
            \Session::put('success', 'Project deleted');
            return Redirect::route('projects');
        }
        \Session::put('error', 'Payment failedwew');
        return Redirect::route('projects');
    }

    public function seekerView(){
        return view('users/seeker');
    }

    //END OF SEEKER

    //BIDDER
    public function getProjectsBidder()
    {
         $projects = DB::table('projects')
            ->where('duration', '>', Carbon::now())
            ->orderByRaw('created_at DESC')
            ->get();  
            return view('users/bidder')->with(compact('projects'));
    }

    public function countBid($id){
        $proposal = Proposal::where('project_id', $id)->count();
        return $proposal;
       // return view('users/bidder')->with(compact('proposal'));
    }

    public function viewProject($id){
    $avg = Proposal::where('project_id', $id)->avg('price');
    $proposals = Project::where(['id' => $id, 'status' => 'open'])->with('proposals')->get();
    $biddings = DB::table('proposals')
    ->join('users', 'users.id', '=', 'proposals.bidder_id')
    ->select('*', 'proposals.id as proposal_id')
    ->orderByRaw('proposals.created_at DESC')
    ->get();
       return view('proposal/bidder')->with(compact('proposals','avg','biddings'));
    }

    public function proposeProject(Request $request, $project_id, $user_id){
        $regex = '/^\d{0,8}(\.\d{1,2})?$/';
        $validator = Validator::make($request->all(),[
            'price' => 'required|regex:'.$regex,
            'description' => 'required',
            'days' => 'required'
        ]);
        if($validator->fails()){
            // dd($validator);
            return redirect('proposals')
                ->withInput()
                ->withErrors($validator);
        }
        $check = Proposal::where('bidder_id', Auth::user()->id)->first();
        $project = Project::where('id', $project_id)->first();
        if($check != null){
            return redirect()->route('proposal', $project_id)
                ->with('error','Already bidded');
        }else{
        $proposal = new Proposal();
        $proposal->bidder_id = Auth::user()->id;
        $proposal->project_id = $project_id;
        $proposal->price = $request->price;
        $proposal->save();
        $proposal_id = $proposal->id;
       
        $details = $request->description;
        $daystoDo = $request->days;
        $data = array_merge(['description' => $details],['daysTODO' => $daystoDo]);
        foreach(array_combine($data['description'], $data['daysTODO']) as $description => $toDo){ 
         DB::table('project_modules')
            ->insert([
                'proposal_id' => $proposal_id,
                'description' => $description,
                'daysTodo' => $toDo,
                'percentDone' => 0
            ]);
        }   
            
       event(new \App\Events\BidNotified(Auth::user()->name,'placed a bid on '.$project->title ,Auth::user()->avatar, "route('projects')"));
       $this->insertNotification(['user_id' => $user_id, 'name' => Auth::user()->firstname.' '.Auth::user()->lastname, 'message' => 'placed a bid on '.$project->title, 'avatar' => Auth::user()->avatar, 'link' => route('projects'), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
       return redirect()->route('bidder');
        }
    }
    public function insertNotification($data){
        DB::table('notifications')->insert($data);
    }

    public function proposalDetails($id){
        $avg = Proposal::where('project_id' , $id)->avg('price');
        $proposals = Project::where(['id' => $id, 'status' => 'open'])->with('proposals')->get();
        $biddings = DB::table('proposals')
            ->join('users', 'users.id', '=', 'proposals.bidder_id')
            ->select('*', 'proposals.id as proposal_id')
            ->orderByRaw('proposals.created_at DESC')
            ->get();
        return view('proposal/details')->with(compact('proposals','avg'));
    }
    //END OF BIDDER
}
