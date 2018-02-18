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
use App\Bid;
// Paypal
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
class BidController extends Controller
{
    private $_api_context;

    public function __construct(){
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function cancelProject($project_id,$bid_id,$project_name,$user_paypal)
    {
        Session::put('project_id', $project_id);
        Session::put('bid_id', $bid_id);
        //dd($project_id);
        $item_name = $project_name;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($item_name)
            ->setCurrency('PHP')
            ->setQuantity(1)
            ->setPrice(200);
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $details = new Details();
        $details->setShipping(5)
            ->setTax(5)
            ->setSubtotal(200);


        $amount = new Amount();
        $amount->setCurrency('PHP')
            ->setTotal(210)
            ->setDetails($details);
            
       /*  $payee = new Payee();
        $payee->setEmail($user_paypal); */

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            // ->setPayee($payee)
            ->setDescription('Cancel project')
            ->setInvoiceNumber(uniqid());

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('cancelprojects.status'))
            ->setCancelUrl(URL::route('cancelprojects.status'));
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
        $bid_id = Session::get('bid_id');
        $project_id = Session::get('project_id');
        $payment_id = Session::get('paypal_payment_id');
        // dd($project_id);
        Session::forget('paypal_payment_id');
        Session::forget('project_id');
        Session::forget('bid_id');
        if(empty(Input::get('PayerID')) || empty(Input::get('token'))){
            \Session::put('error', 'Cancelling bid failed');
            return Redirect::route('projects');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if($result->getState() == 'approved'){
             Bid::where('id', $bid_id)->update(['status'=>'cancelled']); 
             Project::where('id', $project_id)->update(['status'=>'closed']);
            \Session::put('success', 'Bid cancelled');
            return Redirect::route('projects');
        }
        \Session::put('error', 'Cancelling bid failed');
        return Redirect::route('projects');
    }
}
