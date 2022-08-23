<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class FatoorahServices
{
    private $base_url;
    private $headers;
    private $request_client;

    public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;

        $this->base_url = env('fatoora_base_url');
        $this->headers = [
            'Content-Type' => 'application/json',
            'authorization' => 'Bearer ' . env('fatoorah.fatoorah_token'),
        ];
    }

    private function buildRequest($url, $method, $body = [])
    {
        $request = new Request($method, $this->base_url . $url, $this->headers);
        if(!$body)
            return false;
        $response = $this->request_client->send($request, [
            'json' => $body,
        ]);

        if($response->getStatusCode() != 200)
            return false;
        $response = json_decode($response->getBody(), true);
        return $response;
    }

    private function parsePaymentData($patient_id,$value,$planCurrenct)
    {
        return [
            "CustomerName" => $patient['full_name'],
            "NotificationOption" => "LNK",
            "CustomerEmail" => $patient['email'],
            "CustomerMobile" => $patient['phone'],
            "CustomerAddress" => $patient['address'],
            "CustomerCity" => $patient['city'],
            "CustomerState" => $patient['state'],
            "CustomerZip" => $patient['zip'],
            "CustomerCountry" => $patient['country'],
            "CustomerNationalId" => $patient['national_id'],
            "CustomerBirthDate" => $patient['birth_date'],
        ];
    }

    public function sendPayment($patient_id,$fee,$plan_id,$subscriptionPlan)
    {
        $requestData = $this->parsePaymentData();
        $response = $this->buildRequest('v2/SendPayment', 'POST', $requestData);
        if(!$response) {
            $this->saveTransactionPayment($patient_id, $response['Data']['invoiceId']);
        }
        return $response;
    }


    private function saveTransactionPayment($patient_id, $invoice_id)
    {
        $transaction = new Transaction();
        $transaction->patient_id = $patient_id;
        $transaction->invoice_id = $invoice_id;
        $transaction->save();
    }

}
