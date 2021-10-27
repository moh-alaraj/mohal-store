<?php

namespace App\Http\Services;

use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Request;





 class FatoorahServices {

private $base_url ;
private $headers;
private $request_client;




public function __construct(Client $request_client )
{
    $fatoorah = config('services.fatoorah');
    $this->request_client = $request_client;
    $this->base_url = $fatoorah['fatoorah_base'];
    $this->headers = [
        'content-type' => 'application/json',
        'authorization' => 'Bearer '.$fatoorah['fatoorah_token']
    ];

}

private function buildRequest($uri,$method,$data=[])
{

    $request = new Request($method, $this->base_url . $uri, $this->headers);

    if (!$data)
        return false;
    $response = $this->request_client->send($request, [
        'json' => $data
    ]);
    if ($response->getStatusCode() != 200) {
        return false;
    }

    $response = json_decode($response->getBody(), true);
    if (isset($response['Data']['InvoiceURL'])){
        $url = $response['Data']['InvoiceURL'];
        return redirect($url);
    }
        else{
            return $response;
        }

}

    public function sendPayment($data){

         $request = $this->buildRequest('v2/sendPayment' , 'POST' , $data);

        return $request;

    }
    public function getPaymentStatus($data){

        $request = $this->buildRequest('v2/getPaymentStatus' , 'POST' , $data);
        return $request;

    }


 }
