<?php

namespace App\Http\Services;

//use http\Client;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\Http\Services\PaymentGatewayInterface;

class HyperpayServices  implements PaymentGatewayInterface
{

    private $base_url;
    private $headers;
    private $request_client;


    // public function __construct(Client $request_client)
    // {
    //     $this->request_client = $request_client;
    //     //$this->base_url =  config('fatoorah.fatoorah_base_url');
    //     $this->base_url = env('hyperpay_base_url');
    //     $this->headers = [
    //         'Content-Type' => 'application/json',
    //         'authorization' => 'Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg=',   
    //     ];
    // }

    public function buildRequest($url, $method, $price=[])
    {
        $fullurl = env('hyperpay_base_url').$url;
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=".$price['price'].
                    "&currency=EUR" .
                    "&paymentType=DB";


    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fullurl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;   

    }

    public function sendPayment($price)
    {
       $response = $this->buildRequest('/v1/checkouts','POST',$price);
       $id = json_decode($response)->id;
       return view('form',compact('id'));
    }

    public function getPaymentStutas($data)
    {
        $url = "https://eu-test.oppwa.com/v1/checkouts/".$data['id']."/payment";
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";


    
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
       
    }
}
