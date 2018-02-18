<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Module;
use App\Bid;
use App\Project;
use App\User;
use App\Proposal;
use Session;
use DB;
use DateTimeZone;
use Zipper;
use ZipArchive;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
// PAYPAL
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payee;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
class ModuleController extends Controller
{
    private $_api_context;
    public function __construct(){
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    public function getModule($proposal_id,$seeker_id,$project_id)
    {
        $todo = DB::table('bids')
            ->join('proposals','bids.proposal_id','=','proposals.id')
            ->join('modules','modules.proposal_id','=','proposals.id')
            ->where('modules.status','todo')
            ->where('bids.seeker_id', $seeker_id)
            ->where('bids.proposal_id',$proposal_id)
            ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
            ->get();
        $doing = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','bids.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','doing')
          ->where('bids.seeker_id', $seeker_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
          ->get();

          $done = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','bids.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','done')
          ->where('bids.seeker_id', $seeker_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
          ->get();
        
          $project = Project::find($project_id);
          $proposal = DB::table('proposals')
            ->join('users','proposals.bidder_id','=','users.id')
            ->where('proposals.id',$proposal_id)
            ->first();
            return view('ongoing/seeker')
            ->with(compact('todo','doing','done','project','proposal'));
    }

    public function biddergetModule($proposal_id,$bidder_id,$project_id)
    {
        $todo = DB::table('bids')
            ->join('proposals','bids.proposal_id','=','proposals.id')
            ->join('modules','modules.proposal_id','=','proposals.id')
            ->where('modules.status','todo')
            ->where('bids.bidder_id', $bidder_id)
            ->where('bids.proposal_id',$proposal_id)
            ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
            ->get();
        $doing = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','bids.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','doing')
          ->where('bids.bidder_id', $bidder_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
          ->get();

          $done = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','bids.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','done')
          ->where('bids.bidder_id', $bidder_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
          ->get();
        
          $project = DB::table('projects')
            ->join('users','projects.user_id','=','users.id')
            ->first();
          $proposal = DB::table('proposals')
            ->join('users','proposals.bidder_id','=','users.id')
            ->where('proposals.id',$proposal_id)
            ->first();
            return view('ongoing/bidder')
            ->with(compact('todo','doing','done','project','proposal'));
    }
    public function proposalModules(){
        $module_id = $_GET['module_id'];
        $modules = DB::table('proposal_modules')
            ->where('proposal_modules.module_id',$module_id)
            ->get();
        return json_encode($modules);
    }
    // SEEKer
    public function addComment(Request $request){
        $message = ['required' => 'The comment field must not be empty'];
        $validator = Validator::make($request->all(),[
            'progress_comment' => 'required|max:255',
        ], $message);
        if($validator->fails()){
            return redirect()
                ->route('acceptedBid',[$request->comment_proposal,Auth::user()->id,$request->comment_project])
                ->withErrors($validator);
        }
        $ok = DB::table('module_comments')
            ->insert([
                'user_id' => Auth::user()->id,
                'module_id' => $request->comment_module,
                'message' => $request->progress_comment,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Manila')),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Manila'))
            ]); 
             return redirect()
            ->route('acceptedBid',[$request->comment_proposal,Auth::user()->id,$request->comment_project])
            ->with('success','Comment added');
     }
    //  BIDDEr
    public function addCommentBidder(Request $request){
        $message = ['required' => 'The comment field must not be empty'];
        $validator = Validator::make($request->all(),[
            'progress_comment' => 'required|max:255',
        ], $message);
        if($validator->fails()){
            return redirect()
                ->route('myWorks',[$request->comment_proposal,Auth::user()->id,$request->comment_project])
                ->withErrors($validator);
        }
        $ok = DB::table('module_comments')
            ->insert([
                'user_id' => Auth::user()->id,
                'module_id' => $request->comment_module,
                'message' => $request->progress_comment,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Manila')),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Manila'))
            ]); 
             return redirect()
            ->route('myWorks',[$request->comment_proposal,Auth::user()->id,$request->comment_project])
            ->with('success','Comment added');
     }
    //  
     public function moduleComments(){
         $module_id = $_GET['module_id'];
         $comment = DB::table('module_comments')
            ->join('users','users.id','=','module_comments.user_id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','roles.id','=','role_user.role_id')
            ->select('*','roles.name as role_type', 'module_comments.created_at as comment_date')
            ->where('module_id',$module_id)
            ->orderByRaw('module_comments.id DESC')
            ->take(5)
            ->get();
          $comments = $comment->reverse()->values();
          return json_encode($comments);
     }

     public function updateModules(Request $request){
        $module_id = $_POST['module_id'];
        $module_status = $_POST['module_status'];
        DB::table('modules')
            ->where('id',$module_id)
            ->update([
                'status' => $module_status
            ]);
        echo 'ok';
     }

     public function moduleUpdate(){
        $propose_moduleID = $_POST['propose_moduleID'];
        $propose_moduleStatus = $_POST['propose_moduleStatus'];
        $module_percent = $_POST['module_percent'];
        $module_id = $_POST['module_id'];
        DB::table('proposal_modules')
            ->where('id',$propose_moduleID)
            ->update([
                'status' => $propose_moduleStatus
            ]);
        $module = Module::find($module_id);
        $percent = $module->percentDone;
        $total = $percent + $module_percent;
        $module->percentDone = $total;
        /* if($module->percentDone == '100'){
            $module->status = 'done';
        } */
        $module->save();
        echo 'ok';
    }

    public function addFiles(Request $request){
        $message = ['required' => 'You must upload a file'];
        $validator = Validator::make($request->all(),[
            'upload_file' => 'required'
        ],$message);
        if($validator->fails()){
            return back()
                ->with('error_upload',5)
                ->withErrors($validator);
        }
        $module_files = array();
        if($request->hasFile('upload_file')){
            foreach($request->upload_file as $files){
                $files->move('files', $files->getClientOriginalName());
                // $image_path = "files/". $files->getClientOriginalName();
                $module_files[] = $files->getClientOriginalName();
            }
        }
        $file_list = implode(",",$module_files);
        DB::table('modules')
            ->where('id',$request->module_id)
            ->update([
                'status' => 'done',
                'files' => $file_list
            ]);
        return back()
                ->with('success','Module updated');
    }

    public function zipFile(Request $request){
        $public_dir = public_path();
        $zipName = 'files.zip';
        $module_files = Module::find($request->module_id);
        $files = explode(",",$module_files->files);
        $download = array();
        foreach($files as $file){
            $download[] = glob(public_path('files/'.$file));
        }
        Zipper::make($zipName)->add($download);
        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );
        $filetopath = $public_dir.'/'.$zipName;
        if(file_exists($filetopath)){
        return response()->download($filetopath,$zipName,$headers);
        }
        return back();
    }
    public function payProject($project_id,$bid_id,$project_name,$user_paypal){
        Session::put('project_id', $project_id);
        Session::put('bid_id',$bid_id);
        $item_name = $project_name;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        $item_1 = new Item();
        $item_1->setName($item_name)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(4);
        
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $details = new Details();
        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(4);

        $amount = new Amount();
        $amount->setCurrency('PHP')
            ->setTotal(6.5)
            ->setDetails($details);
        
        $payee = new Payee();
        $payee->setEmail($user_paypal);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setPayee($payee)
            ->setDescription('Payment')
            ->setInvoiceNumber(uniqid());
        
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))
            ->setCancelUrl(URL::route('payment.status'));
        
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
                // return Redirect::route('projects');
                return back();
            }else{
                \Session::put('error', 'An error occured');
                // return Redirect::route('projects');
                return back();
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
        \Session::put('error',' Unknown error occured');
        // return Redirect::route('projects');
        return back();
    }

    public function paymentStatus(){
        $bid_id = Session::get('bid_id');
        $project_id = Session::get('project_id');
        $paypal_payment_id = Session::get('paypal_payment_id');
    
        Session::forget('paypal_payment_id');
        Session::forget('project_id');
        Session::forget('bid_id');
        if(empty(Input::get('PayerID')) || empty(Input::get('token'))){
            \Session::put('error', 'Payment failed');
            // return Redirect::route('projects');
            return back();
        }
        $payment = Payment::get($paypal_payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if($result->getState() == 'approved'){
            \Session::put('success', 'Payment Success');
            // return Redirect::route('projects');
            return back();
        }
        \Session::put('error','Payment failed');
        // return Redirect::route('projects');
        return back();
    }
}
