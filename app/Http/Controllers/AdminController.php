<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Role;
use Carbon\Carbon;
// use App\Transaction;
use App\Report;
use App\Proposal;
use App\Module;
use DB;
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
// SALE
use PayPal\Api\Sale;
use PayPal\Api\Refund;
use PayPal\Api\RefundRequest;
class AdminController extends Controller
{
    private $_api_context;
    public function __construct(){
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function totalUsers(){
        $users = DB::table('users')
            ->join('role_user','role_user.user_id','=','users.id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->where('roles.name','!=','admin')
            ->count();
        return $users;
    }
    public function newProjects(){
        $projects = DB::table('projects')
            ->whereDate('created_at', '=', Carbon::today()->toDateString())
            ->count();
         return $projects;
    }
    public function totalProjects(){
        $projects = Project::all()->count();
        return $projects;
    }

    public function totalReports(){
        $reports = Report::all()->count();
        return $reports;
    }


    public function monthlyCommision(){
        $commisions = DB::table('transactions')
            ->select(DB::raw('SUM(commission) as monthly_commission, MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at) ASC'))
            ->get();
        echo json_encode($commisions);
    }
    
    public function deactivateUser(){
        $user_id = $_POST['user_id'];
        DB::table('users')
            ->where('id',$user_id)
            ->update(['status' => 0]);
    }
    public function activateUser(){
        $user_id = $_POST['user_id'];
        DB::table('users')
            ->where('id',$user_id)
            ->update(['status' => 1]);
    }

    public function viewUser(){
       $user_id = $_GET['user_id'];
       $users = User::find($user_id);
       echo json_encode($users); 
    }

    public function openProjects(){
        $openProjects = Project::where('status','open')->count();
        $ongoingProjects = Project::where('status','ongoing')->count();
        $doneProjects = Project::where('status','done')->count();
        $totalProjects = Project::all()->count();
        return view('admin/projects',compact('openProjects','ongoingProjects','doneProjects','totalProjects'));
    }
    public function monthlyProjects(){
        $monthlyProjects = DB::table('projects')
            ->select(DB::raw('COUNT(id) as monthly_projects, MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at) ASC'))
            ->get();
        echo json_encode($monthlyProjects);
    }

    public function userSeeker(){
        $seekers = User::whereHas('roles', function($q){
            $q->where('name','seeker');
        })->count();
      return $seekers;
    }
    public function bannedSeekers(){
        $seekers =  User::whereHas('roles', function($q){
            $q->where('name','seeker');
        })->where('status',0)
        ->count();
        return $seekers;
    }
    public function activeSeekers(){
        $seekers =  User::whereHas('roles', function($q){
            $q->where('name','seeker');
        })->where('status',1)
        ->count();
        return $seekers;
    }

    public function userBidder(){
        $bidders =  User::whereHas('roles', function($q){
            $q->where('name','bidder');
        })->count();
      return $bidders;
    }
    public function bannedBidder(){
        $bidders =  User::whereHas('roles', function($q){
            $q->where('name','bidder');
        })->where('status',0)
        ->count();
        return $bidders;
    }
    public function activeBidder(){
        $bidders =  User::whereHas('roles', function($q){
            $q->where('name','bidder');
        })->where('status',1)
        ->count();
        return $bidders;
    }
    
    public function seekerReports($seeker_id){
        $reports = Report::where('seeker_id',$seeker_id)->count();
        return $reports;
    }

    public function bidderReports($bidder_id){
        $reports = Report::where('bidder_id',$bidder_id)->count();
        return $reports;
    }

    public function getBannedBidders(){
        $bidders =  User::whereHas('roles', function($q){
            $q->where('name','bidder');
        })->where('status',0)
        ->get();
        return $bidders;
    }
    public function getBannedSeekers(){
        $seekers =  User::whereHas('roles', function($q){
            $q->where('name','seeker');
        })->where('status',0)
        ->get();
        return $seekers;
    }

    public function presentationReports(){
        $reports = DB::table('presentation_reports')
            ->get();
        return view('admin/presentation', compact('reports'));
    }

    public function getUser($user_id){
        $user = User::find($user_id);
        return $user;
    }
    public function getProject($project_id){
        $project = Project::find($project_id);
        return $project;
    }

    public function pendingPresentation(){
        $pending = DB::table('presentation_reports')
                    ->where('seeker_status',0)
                    ->where('bidder_status',0)
                    ->count();
        return $pending;
    }

    public function donePresentation(){
        $done = DB::table('presentation_reports')
                    ->where('seeker_status',1)
                    ->where('bidder_status',1)
                    ->count();
        return $done;
    }

    public function totalPresentation(){
        $total = DB::table('presentation_reports')
            ->count();
        return $total;
    }

    public function totalCommision(){
        $total = DB::table('transactions')->sum('commission');
        return $total;
    }

    public function checkRefund($project_id){
        $status = DB::table('transactions')
            ->join('presentation_reports','transactions.project_id','=','presentation_reports.project_id')
            ->where('presentation_reports.project_id',$project_id)
            ->select('*','transactions.id as transact_id')
            ->first();
        return $status;
    }

    public function sendRefund(){
        $transact_id = $_POST['transact_id'];
        $project_id = $_POST['project_id'];
        $payment_id = $_POST['payment_id'];
        $php_amount = $_POST['refund_amount'];
        $payment = Payment::get($payment_id, $this->_api_context);
        $payment->getTransactions();
        $obj = $payment->toJSON();
        $paypal_obj = json_decode($obj);
        $transaction_id = $paypal_obj->transactions[0]->related_resources[0]->sale->id;
        $sale = Sale::get($transaction_id, $this->_api_context);
        $test =  $sale->getId();
        // $refund_amount = round($php_amount / 50,2);
        $amount = new Amount();
        $amount->setCurrency('PHP')
            ->setTotal($php_amount);
        $refundRequest = new RefundRequest();
        $refundRequest->setAmount($amount);
        $sale = new Sale();
        $sale->setId($transaction_id);
        $output = $sale->refundSale($refundRequest, $this->_api_context);
        if($output){
              DB::table('transactions')
            ->where('id',$transact_id)
            ->update([
                'status' => 'Refunded'
            ]);
        $proposal_id = Proposal::where('project_id', $project_id)->first();
        $module_id = DB::table('modules')
                ->where('proposal_id', $proposal_id->id)
                ->pluck('id')
                ->toArray();
        foreach($module_id as $module){
             DB::table('module_comments')
                ->where('module_id', $module)
                ->delete();
            DB::table('proposal_modules')
                ->where('module_id', $module)
                ->delete();
            Module::find($module)->delete();
            
        }
        Proposal::where('id', $proposal_id->id)->delete();
        Project::where('id',$project_id)->update(['status'=>'refunded']);
        event(new \App\Events\RefundEvent('A refund has been sent to your paypal'));
        }else{
            echo 'error';
        }
    }
}
