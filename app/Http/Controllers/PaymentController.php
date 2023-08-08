<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use GuzzleHttp\Client;
use Spatie\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    public function RazorpayOrder()
    {


        try {
            DB::beginTransaction();

            // $order = Order::create([
            //     'order_id' => rand(100000, 999999),
            //     'amount' => request('amount'),
            // ]);

            // foreach (request('cartItem') as $key => $value) {
            //     Cart::find($value['id'])->update([
            //         'order_id' => $order->id,
            //     ]);
            // }

            // $client = new Client();

            // $response = $client->post('https://api.razorpay.com/v1/orders', [
            //     'headers' => [
            //         'content-type' => 'application/json'
            //     ],
            //     'auth' => ['rzp_test_aCr7DTwOQRRkvp', 'C1kCRrhXdhmvS60cBXs4olpB'],

            //     'json' => [
            //         'amount' => request('amount') * 100,
            //         'currency' => 'INR',
            //         'receipt' => (string)rand(100000, 999999),

            //     ]
            // ]);

            // return response()->json(['data' => json_decode($response->getBody()), 'order_id' => $order->id]);




            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'data' => $e->getMessage()
            ]);
        }



        // return view('payment.razor-pay');
    }


    public function RazorpayPayment()
    {
        return view('payment.razor-pay');
    }
}
