<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use URL;
use Session;
use Redirect;
use DB;
use App\Project;
use App\User;
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


    public function create(Request $request){
        $regex = '/^\d{0,8}(\.\d{1,2})?$/';
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
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

        $projects = new Project();
        $projects->user_id = Auth::id();
        $projects->title = $request->title;
        $projects->details = $request->details;
        $projects->start = $request->start;
        $projects->end = $request->end;
        $projects->category = $request->category;
        $projects->min = $request->min;
        $projects->max = $request->max;
        $projects->save();

        return redirect()->route('projects')->with('success','Data added');

    }
    

    public function openProject(Request $request, $id){
        $regex = '/^\d{0,8}(\.\d{1,2})?$/';
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
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
        $projects->start = $request->start;
        $projects->end = $request->end;
        $projects->category = $request->category;
        $projects->min = $request->min;
        $projects->max = $request->max;
        $projects->status = '1';
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
            ->update(array('status'=>0));
        
        return redirect()->route('projects')
            ->withInput(['tab'=>'closed'])
            ->with('success','Project closed');
    }

    public function myProjects(){
        $projects = DB::table('projects')
            ->where(['user_id' => Auth::user()->id,
            'status' => '1'])
            ->orderByRaw('created_at DESC')
            ->get();

      $closedprojects = DB::table('projects')
            ->where(['user_id' => Auth::user()->id,
            'status' => '0'])
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

    public function getProjectsBidder()
    {
        $projects = DB::table('projects')
            ->join('users', 'projects.user_id', '=', 'users.id')
            ->orderBy('projects.id','desc')
            ->select('*','projects.id as project_id')
            ->get();

            return view('users/bidder')->with(array('projects'=>$projects));
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

    /*public function closedProjects()
    {
        $projects = DB::table('projects')
            ->where(['user_id' => Auth::user()->id,
            'status' => '0'])
            ->orderByRaw('created_at DESC')
            ->get();

            return view('users/seeker')->with(array('closedprojects'=>$projects));
    }*/

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
}
