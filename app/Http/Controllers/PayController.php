<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Events\NewMessage;
use Devinweb\LaravelHyperpay\Facades\LaravelHyperpay;
use App\Http\Services\PaymentGatewayInterface;



class PayController extends Controller
{
   
    // private $paymentGateway;
    
    // public function __construct(PaymentGatewayInterface $paymentGateway)
    // {
    //    $this->paymentGateway = $paymentGateway;
    // }

    public function pay(PaymentGatewayInterface $paymentGateway)
    {
         $data =[
            'CustomerName' =>'Ahmed hassan',
            'NotificationOption' =>'LNK',
            'InvoiceValue'=>100,
            'CustomerEmail'=>'a@hotmail.com',
            "CallBackUrl" => env('sueccss_url'),
            'ErrorUrl'=> env('error_url'),
            'Language'=>'en',
            'DisplayCurrencyIso'=>'SAR'
          ];
 
        return $paymentGateway->sendPayment($data);
    }

    
    public function callback(Request $request,PaymentGatewayInterface $paymentGateway)
    {
        $data=[];
        $data['Key'] = $request->paymentId;
        $data['KeyType'] =  'paymentId';  
        return $paymentGateway->getPaymentStutas($data); 
    }

    public function pay2(PaymentGatewayInterface $paymentGateway)
    {
        $data =[
            'price' =>555,
        ];
        return $paymentGateway->sendPayment($data);
    }
    

    public function callback_hyperpay(PaymentGatewayInterface $paymentGateway)
    {
        $data=['id'=>$_GET['id']];
        return $paymentGateway->getPaymentStutas($data); 
    }


    
}
