<?php

namespace App\service;

use GuzzleHttp\Client;





class InvoiceService
{
    public function createInvoice()
    {


        $client = new Client();

        $response = $client->post('https://api.razorpay.com/v1/invoices', [
            'headers' => [
                'content-type' => 'application/json'
            ],
            'auth' => ['rzp_test_aCr7DTwOQRRkvp', 'C1kCRrhXdhmvS60cBXs4olpB'],
            'json' => [
                "type" => "invoice",
                "description" => "Invoice for the month of January 2020",
                "partial_payment" => true,
                "draft"=>0,
                
                "customer" => [
                    "name" => "hardik pandya",
                    "contact" => 7062184323,
                    "email" => "hardik@bcci.com",
                    "billing_address" => [
                        "line1" => "Ground & 1st Floor, SJR Cyber Laskar",
                        "line2" => "Hosur Road",
                        "zipcode" => "560068",
                        "city" => "Bengaluru",
                        "state" => "Karnataka",
                        "country" => "in"
                    ],
                    "shipping_address" => [
                        "line1" => "Ground & 1st Floor, SJR Cyber Laskar",
                        "line2" => "Hosur Road",
                        "zipcode" => "560068",
                        "city" => "Bengaluru",
                        "state" => "Karnataka",
                        "country" => "in"
                    ]
                ],
                "line_items" => [
                    [
                        "name" => "Master Cloud Computing in 30 Days",
                        "description" => "Book by Ravena Ravenclaw",
                        "amount" => 200000,
                        "currency" => "INR",
                        "quantity" => 2
                    ]
                ],


            ]

        ]);

        $responseData = $response->getBody()->getContents();
        dd(json_decode($responseData));
    }
}
