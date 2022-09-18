<?php

use GuzzleHttp\Client;
use Guzzle\Http\EntityBody;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use GuzzleHttp\Exception\RequestException;
class Payment
{
    private $merchantToken = "Basic TUVSQ0hBTlRfUEFZTUVOVF9HQVRFV0FZOk1lcmNoYW50R2F0ZXdheUBBZG1pbiMxMjM="; 
    private $username = "7500077954";  
    private $password = "Nass@2020";    
    private $grantType = "password";
    private $transactionPin = "135758";   
    private $orderId = "263626";     
    private $amount = "10";           
    private $languageCode = "en";
    private $client;


    public function __construct()
    {$this->client = new Client([
            'base_uri' => 'https://uatgw1.nasswallet.com/payment/transaction/',
            'timeout' => '1000'
        ]); }

    public function loginWithMerchantAccount()
    {     
        $payload = [
            "data" => [
                "username" => $this->username,
                "password" => $this->password,
                "grantType" => $this->grantType
            ]];
        $response = json_decode($this->client->request('POST', 'login', [
            "headers" => ['authorization' => "$this->merchantToken"],
            'json' => $payload
            
        ])->getBody());
    
        if ($response->responseCode == 0 && $response->data->access_token) {
            $response =  $response->data->access_token;
            $this->makeTransaction($response);
        } else {
             return $response->message;
        }}

     public function makeTransaction($access_token)
    {$payload = [
            'data' => [
                'userIdentifier' => $this->username,
                'transactionPin' => $this->transactionPin,
                'orderId' => $this->orderId,
                'amount' => $this->amount,
                'languageCode' => $this->languageCode
            ]];
        $response = json_decode($this->client->request('POST', 'initTransaction', [
            "headers" => ['authorization' => "Bearer $access_token"],
            "json" => $payload
        ])->getBody());

        if ($response->responseCode == 0 && $response->data->transactionId) {
            
            echo "https://uatcheckout1.nasswallet.com/payment-gateway?id={$response->data->transactionId}&token={$response->data->token}&userIdentifier={$this->username}";
           
        }else {
            return "something went wrong!";
        }
        
    }
 
}
