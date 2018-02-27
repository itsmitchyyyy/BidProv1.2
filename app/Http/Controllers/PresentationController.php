<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Bid;
use App\Proposal;
use App\Module;
// use App\Transaction;
use Illuminate\Support\Facades\Auth;
use DB;
// PAYOUT
use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
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
class PresentationController extends Controller
{
    private $_api_context;
    public function __construct(){
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function bidderUpdate($status,$project_id,$user_id,$price){
        DB::table('presentation_reports')
            ->where('project_id', $project_id)
            ->update([
                'bidder_status' => $status
            ]);
        $this->payBidder($project_id,$user_id,$price);
        return back()
                ->with('success','Presentation updated');
    }

    public function seekerUpdate($status,$project_id,$user_id,$price){
       
        DB::table('presentation_reports')
            ->where('project_id', $project_id)
            ->update([
                'seeker_status' => $status
            ]);
        $this->payBidder($project_id,$user_id,$price);
        return back()
        ->with('success','Presentation updated');
    }

    public function checkBidPresentation($project_id, $bidder_id){
        $status = DB::table('presentation_reports')
            ->where(['project_id' => $project_id, 'bidder_id' => $bidder_id])
            ->first();
        return $status;
    }

    public function checkSeekPresentation($project_id, $seeker_id){
        $status = DB::table('presentation_reports')
            ->where(['project_id' => $project_id, 'seeker_id' => $seeker_id])
            ->first();
        return $status;
    }

    public function payBidder($project_id,$user_id,$price){
        $toPay = $price;
        $percentToGet = 5;
        $percentInDecimal  = $percentToGet / 100;
        $percent = $percentInDecimal * $toPay;
        $tax =  round($percent / 2,2);
        $total_tax = $tax * 2;
        $total = $toPay - $total_tax;
        $value = round($total,2);
        $php = $value / 50;
        $final_amount = round($php,2);
        $user = User::find($user_id);
        $receiver = $user->paypal;
        $pays = DB::table('presentation_reports')
            ->where('project_id',$project_id)
            ->first(['seeker_status','bidder_status']);
        
        if($pays->seeker_status == 1 && $pays->bidder_status == 1){
            DB::table('transactions')
                ->where('project_id',$project_id)
                ->update([
                    'status' => 'Paid'
                ]);
            $payouts = new Payout();
            $senderBatchHeader = new PayoutSenderBatchHeader();
            $senderBatchHeader->setSenderBatchId(uniqid())
                ->setEmailSubject("You have a payment");
            $senderItem1 = new PayoutItem(
                '{
                    "recipient_type": "EMAIL",
                    "amount": {
                        "value": "'.$final_amount.'",
                        "currency": "USD"
                    },
                    "receiver": "'.$receiver.'",
                    "note": "Payment for the project.",
                    "sender_item_id": "'.uniqid().'"
            }'
        );
        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem1);
        $output = $payouts->create(null,$this->_api_context);
        event(new \App\Events\PaymentEvent('A payment has been sent to your paypal'));
        }
    }

    /* public function notifyBidder($bidder_id){
        $reports = DB::table('presentation_reports')
            ->where('bidder_id',$bidder_id)
            ->get();
        echo json_encode($reports);
    } */
}
