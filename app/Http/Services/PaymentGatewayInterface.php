<?php

namespace App\Http\Services;

interface PaymentGatewayInterface
{
    public function buildRequest($url, $method, $data=[]);
    public function sendPayment($data);
    public function getPaymentStutas($data);
}