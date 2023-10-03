<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use GuzzleHttp\Client;
use Spatie\FlareClient\Api;
use Illuminate\Http\Request;
use App\service\InvoiceService;
use App\service\PaymentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{

    public function invoice()
    {
        $invoiceService = new InvoiceService();
        $invoice = $invoiceService->createInvoice();
        return $invoice;
    }
    public function makePayment()
    {
        try {
            $paymentService = new PaymentService();
            $responseData = $paymentService->fetchPaymentStatus(request('razorpay_payment_id'));

         

            $order = Order::where('razor_order_id', request('razorpay_order_id'))->first();
            $order->update([
                'payment_id' => request('razorpay_payment_id'),
                'payment_status' => $responseData['status'] == 'captured' ? Order::PAID : Order::UNPAID,

            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Payment done successfully',
                'data' => $order,
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => 501,
                'message' => 'Something went wrong',
                'data' => $th->getMessage(),
            ], 501);
        }
    }
    public function RazorpayOrder()
    {


        try {
            if (request('cartItem')[0]['order_id'] != null) {

                $test_order = order::select('razor_order_id', 'order_id')->where('id', request('cartItem')[0]['order_id'])->first();

                return response()->json([
                    'status' => 200,
                    'message' => 'Order Ids are already generated',
                    'razor_order_id' => ($test_order->razor_order_id),
                    'order_id' => $test_order->order_id,

                ]);
            }

            DB::beginTransaction();
            $order = Order::create([
                'order_id' => rand(100000, 999999),
                'amount' => request('amount'),
                'user_id'=>Auth::id()
            ]);

            foreach (request('cartItem') as $key => $value) {
                Cart::find($value['id'])->update([
                    'order_id' => $order->id,
                    'product_price'=>$value['product_price'],
                ]);
            }

            $client = new Client();

            $response = $client->post('https://api.razorpay.com/v1/orders', [
                'headers' => [
                    'content-type' => 'application/json'
                ],
                'auth' => ['rzp_test_aCr7DTwOQRRkvp', 'C1kCRrhXdhmvS60cBXs4olpB'],

                'json' => [
                    'amount' => request('amount') * 100,
                    'currency' => 'INR',
                    'receipt' => (string)rand(100000, 999999),

                ]
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);
            $order->update(['razor_order_id' => $responseData['id']]);
            DB::commit();


            return response()->json(['status' => 200, 'message' => 'Order Ids are generated', 'razor_order_id' => $order->razor_order_id, 'order_id' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 501,
                'message' => 'Something went wrong',
                'data' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ], 501);
        }



        // return view('payment.razor-pay');
    }


    public function RazorpayPayment()
    {
        return view('payment.razor-pay');
    }
}
