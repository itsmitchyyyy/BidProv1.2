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
use Redirect;
use DateTimeZone;
use URL;
use Zipper;
use ZipArchive;
use Carbon\Carbon;
use Illuminate\Mail\Message;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
// PAYOUT
use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
// PAYPAL\
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
         ->join('proposals','bids.proposal_id','=','proposals.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','doing')
          ->where('bids.seeker_id', $seeker_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
          ->get();

          $done = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','proposals.id')
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
           $module = Module::where('proposal_id', $proposal_id)
                    ->pluck('status')
                    ->toArray();
           $transactions = DB::table('transactions')
            ->join('users','users.id','=','transactions.seeker_id')
            ->where('transactions.seeker_id',Auth::user()->id)
            ->where('transactions.project_id',$project_id)
            ->first();
            // dd($transactions);
            $bids = Bid::where('proposal_id', $proposal_id)->first();

            return view('ongoing/seeker')
            ->with(compact('todo','doing','done','project','proposal','module','bids','transactions'));
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
         ->join('proposals','bids.proposal_id','=','proposals.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','doing')
          ->where('bids.bidder_id', $bidder_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
          ->get();

          $done = DB::table('bids')
         ->join('proposals','bids.proposal_id','=','proposals.id')
         ->join('modules','modules.proposal_id','=','proposals.id')
          ->where('modules.status','done')
          ->where('bids.bidder_id', $bidder_id)
          ->where('bids.proposal_id',$proposal_id)
          ->select('*','proposals.bidder_id as proposal_bidder_id','modules.id as module_id','modules.status as module_status')
          ->get();
        
          $project = DB::table('projects')
            ->join('users','projects.user_id','=','users.id')
            ->select('*','projects.id as project_id')
            ->first();
       
        $module = Module::where('proposal_id', $proposal_id)
            ->whereIn('status',['doing','todo'])
        ->count();

          $proposal = DB::table('proposals')
            ->join('users','proposals.bidder_id','=','users.id')
            ->where('proposals.id',$proposal_id)
            ->first();
            return view('ongoing/bidder')
            ->with(compact('todo','doing','done','project','proposal','module'));
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
          
     }

     public function sendMail($receiver,$project_name,$client_email,$location,$time,$date,$developer_name,$proposal_price,$award_date,$developer_email,$developer_contact){
        $data['receiver'] = $receiver;
        $data['project_name'] = $project_name;
        $data['location'] = $location;
        $data['time'] = $time;
        $data['date'] = $date;
        $data['developer'] = $developer_name;
        $data['price'] = $proposal_price;
        $data['award'] = $award_date;
        $data['email'] = $developer_email;
        $data['contact'] = $developer_contact;
        $client_mail = $client_email;
        $to_receiver = $receiver;
        \Mail::send('email/seeker',  $data, function($message) use($client_mail,$to_receiver){
            $message->to($client_mail,$to_receiver)
                ->subject('Project');
        });
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
        $module->save();
        echo 'ok';
    }

    public function addFiles(Request $request){
        $project = $request->project_id;
        $client = $request->client_id;
        $proposal_id = $request->proposal_id;
        $project_name = Project::find($project);
        $client_name = User::find($client);
        // dd(Carbon::parse($request->module_date)->toFormattedDateString());
        // PROPOSAL PRICE
        $proposal = Proposal::where(['id' => $proposal_id, 'bidder_id' => Auth::id()])->first(['price']);
        $proposal_price = $proposal->price;
        // DEVELOPER NAME
        $developer = User::where('id',Auth::id())->first(['firstname','lastname','email','mobile_no']);
        $developer_name = ucfirst($developer->firstname).' '.ucfirst($developer->lastname);
        $developer_email = $developer->email;
        $developer_contact = $developer->mobile_no;
        // RECIVER
        $receiver = ucfirst($client_name->firstname).' '.ucfirst($client_name->lastname);
        // PROJECT TITLE
        $project_title = strtoupper($project_name->title);
        // CLIENT EMAIL
        $client_email = $client_name->email;
        // MODULE STATUS 
        
            // MODULE CREATED
        $award = Bid::where('proposal_id', $proposal_id)
            ->first(['created_at']);
        $award_date = Carbon::parse($award->created_at)->toFormattedDateString();
        // MAIN FUNCTIONS
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
        $module = Module::where('proposal_id', $proposal_id)
            ->pluck('status')
            ->toArray();
        if($request->module_date != ''){
            $meetup_date = Carbon::parse($request->module_date)->toFormattedDateString();
                 if(count(array_unique($module)) === 1 && end($module) === 'done'){      
                     DB::table('presentation_reports')
                        ->insert([
                            'seeker_id' => $client,
                            'bidder_id' => Auth::id(),
                            'project_id' => $project,
                            'created_at' => Carbon::now(new DateTimeZone('Asia/Manila')),
                            'updated_at' => Carbon::now(new DateTimeZone('Asia/Manila'))
                        ]);             
                $this->sendMail($receiver,$project_title,$client_email,$request->module_place,$request->module_time,$meetup_date,$developer_name,$proposal_price,$award_date,$developer_email,$developer_contact);
                }
            }
        return back()
                ->with('success','Module updated');
    }

    public function checkPayment(){
        $project_id = $_POST['project_id'];
        $payment = DB::table('transactions')
            ->join('users','users.id','=','transactions.seeker_id')
            ->where('transactions.seeker_id', Auth::user()->id)
            ->where('transactions.project_id',$project_id)
            ->get();
        echo json_encode($payment);
    }

    public function zipFile(Request $request){
        $public_dir = public_path();
        $file_name = Carbon::now(new DateTimeZone('Asia/Manila'))->timestamp;
        $zipName = $file_name.".zip";
        $module_files = Module::find($request->module_id);
        $files = explode(",",$module_files->files);
        $download = array();
        foreach($files as $file){
            $download[] = glob(public_path('files/'.$file));
        }
        Zipper::make($zipName)->add($download)->close();
        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );
        $filetopath = $public_dir.'/'.$zipName;
        if(file_exists($filetopath)){
        return response()->download($filetopath,$zipName,$headers);
        }
       
        return back();
    }
    public function payProject($project_id,$bid_id,$project_name,$user_paypal,$amount,$user_id){
        $toPay = $amount;
        $percentToGet = 5;
        $percentInDecimal  = $percentToGet / 100;
        $percent = $percentInDecimal * $toPay;
        $tax =  round($percent / 2,2);
        $total_tax = $tax * 2;
        $total = $toPay - $total_tax;
        // $percentage = round($total_tax,2);
        Session::put('user_id', $user_id);
        Session::put('project_id', $project_id);
        Session::put('bid_id',$bid_id);
        Session::put('pay_amount', $amount);
        Session::put('commission', $total_tax);
        Session::put('total', $total);
        $item_name = $project_name;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        $item_1 = new Item();
        $item_1->setName($item_name)
            ->setCurrency('PHP')
            ->setQuantity(1)
            ->setPrice($toPay);
        
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        /* $details = new Details();
        $details->setFee($total_tax); */
        

        $amount = new Amount();
        $amount->setCurrency('PHP')
            ->setTotal($toPay);
            // ->setDetails($details);

        /* $payee = new Payee();
        $payee->setEmail($user_paypal); */

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            // ->setPayee($payee)
            ->setDescription('The amount is partially directed to admin accounts after the presentation of the bidder the admin will pay the bidder with a commission of 5%')
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
        $user_id = Session::get('user_id');
        $bid_id = Session::get('bid_id');
        $project_id = Session::get('project_id');
        $paypal_payment_id = Session::get('paypal_payment_id');
        $total = Session::get('pay_amount');
        $percent_commision = Session::get('commission');
        $amount_pay = Session::get('total');
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
            /* $payouts = new Payout();
            $senderBatchHeader = new PayoutSenderBatchHeader();
            $senderBatchHeader->setSenderBatchId(uniqid())
                ->setEmailSubject("You have a payment");
            $senderItem1 = new PayoutItem(
                '{
                    "recipient_type": "EMAIL",
                    "amount": {
                        "value": "'.$percent_commision.'",
                        "currency": "USD"
                    },
                    "receiver": "bidproadmin@gmail.com",
                    "note": "Commission fee.",
                    "sender_item_id": "'.uniqid().'"
            }'
        );
        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem1);
        $output = $payouts->create(null,$this->_api_context); */
            DB::table('bids')->where('id',$bid_id)->update(['status'=>'done']);
            DB::table('projects')->where('id',$project_id)->update(['status'=>'done']);
            $transaction = array(
                'seeker_id' => Auth::user()->id,
                'bidder_id' => $user_id,
                'project_id' => $project_id,
                'payment_id' => $paypal_payment_id,
                'amount' => $amount_pay,
                'commission' => $percent_commision,
                'total' => $total,
                'status' => 'Pending',
                'created_at' => Carbon::now(new DateTimeZone('Asia/Manila')),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Manila'))
            );
            DB::table('transactions')->insert($transaction); 
            \Session::put('success', 'Payment Success');
                return Redirect::route('rate.show', $user_id);
            // return Redirect::route('projects');
            // return back();
        }
        \Session::put('error','Payment failed');
        // return Redirect::route('projects');
        return back();
    }

    /* public function payProject($project_id,$bid_id,$project_name,$user_paypal,$amount,$user_id){
     
        $payouts = new Payout();
        $senderBatchHeader = new PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a payment");
        $senderItem1 = new PayoutItem(
            '{
                "recipient_type": "EMAIL",
                "amount": {
                    "value": 0.90,
                    "currency": "USD"
                },
                "receiver": "adminbidpro@gmail.com",
                "note": "Thank you.",
                "sender_item_id": "'.uniqid().'"
        }'
    );
    $payouts->setSenderBatchHeader($senderBatchHeader)
        ->addItem($senderItem1);
        $output = $payouts->create(null,$this->_api_context);
       dd($output);
    } */
}
