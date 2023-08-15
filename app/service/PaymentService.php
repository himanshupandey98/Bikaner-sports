<?php

namespace App\service;

use GuzzleHttp\Client;





class PaymentService
{
    public function fetchPaymentStatus($razor_payment_id)
    {

        $client = new Client();

        $response = $client->get('https://api.razorpay.com/v1/payments/'.$razor_payment_id, [
            'headers' => [
                'content-type' => 'application/json'
            ],
            'auth' => ['rzp_test_aCr7DTwOQRRkvp', 'C1kCRrhXdhmvS60cBXs4olpB'],

           
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);
        return $responseData;
    }
}
