<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Transaction;
use Session;
use Redirect;


class ChargeController extends Controller
{
    //
    public function index(){
        return View('home');
    }
    public function charge(Request $request){
        \Stripe\Stripe::setApiKey('sk_test_51HAywoF5XdSNS1a5pznD6Z5pumLtg6qlnu6De5ju3nCxTBiyyey70C0TlnGddYfZSVzc2jsDySTrpfkcgdQUFhOY00LXW5kDEW');

        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'amount'=>'required',
            'stripeToken'=>'required',
        ]);

        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $email = $request['email'];
        $amount = $request['amount'];
        $token = $request['stripeToken'];

        $existing_customer = Customer::where('email', '=', $request->email)->latest()->first()->toArray();

        if($existing_customer['balance']>0){
            $prev_amount = $existing_customer['balance'];
        }
        else
        {
            $prev_amount = 0;
        }  

        $balance = $amount+$prev_amount;

        $customer= \Stripe\Customer::create(array(
            "email" => $email,
            "source" => $token
        ));

        $charge = \Stripe\Charge::create(array(
            "amount" => $amount*100,
            "currency" => "inr",
            "description" => "Top-Up of Rs.".$amount,
            "customer"=>$customer->id
        ));

        $customer= new Customer();
        $customer->id=$charge->customer;
        $customer->first_name=$first_name;
        $customer->last_name=$last_name;
        $customer->email=$email;
        $customer->amount=$amount;
        $customer->balance=$balance;
        $customer_save=$customer->save();

        if($customer_save){
            $transaction=new Transaction();
            $transaction->id=$charge->id;
            $transaction->customer_id=$charge->customer;
            $transaction->amount=$amount;
            $transaction->currency=$charge->currency;
            $transaction->status=$charge->status;
            $transaction_save=$transaction->save();
        }

        if($transaction_save){
            $data=array("tid" => $charge->id,"topup"=>$amount,"balance"=>$balance);
            return View('success')
            ->with($data);
        }    

    }
}
