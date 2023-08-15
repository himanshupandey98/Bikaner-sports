<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OrderController extends Controller
{

    public function customerOrders()
    {
        $orders = Order::with([
            'cart' => function ($query) {
                $query->with(['variant' => function ($query) {
                    $query->select('id', 'image', 'price');
                }]);
            }
        ])->get();
       
        foreach ($orders as $order) {
            
            foreach ($order['cart'] as $cart) {
                $cart->product_image = url('storage/product-variant-image/' . $cart->variant->image);
                $cart->product_price = $cart->variant->price;
                
            }
           
        }
        
       
        return view('order', ['orders' =>$orders]);
    }
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.list', compact('orders'));
    }

    public function show($id)
    {
        $id = Crypt::Decrypt($id);
        $order = Order::with([
            'cart' => function ($query) {
                $query->with(['variant' => function ($query) {
                    $query->select('id', 'image', 'price');
                }]);
            }
        ])->find($id);
        $subTotal = 0;
        foreach ($order['cart'] as $cart) {
            $cart->product_image = url('storage/product-variant-image/' . $cart->variant->image);
            $cart->product_price = $cart->variant->price;
            $subTotal = $subTotal + ($cart->product_price * $cart->product_qty);
        }
        $order->subtotal = $subTotal;
        return view('admin.order.show', compact('order'));
    }

    public function changeOrderStatus()
    {
        $order = Order::find(request('order_id'));
        $order->update([
            'order_status' => request('order_status')
        ]);
        return redirect()->back()->with('success', 'Order status updated successfully');
    }
    public function fetchOrderStatus()
    {
        $orders = Order::where('order_status', request('order_status'))->get();
        return view('admin.order.list', compact('orders'));
    }
    public function paymentStatus()
    {
        $orders = Order::where('payment_status', request('payment_status'))->get();
        return view('admin.order.list', compact('orders'));
    }























    public function getOrderForPayment()
    {
        try {
            $order = Order::where('id', request('order_id'))->first();
            return response()->json([
                'status' => 200,
                'message' => 'Order fetched successfully',
                'data' => $order,

            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong',
                'data' => $th->getMessage(),

            ]);
        }
    }
}
