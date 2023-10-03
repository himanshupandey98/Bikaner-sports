<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ReturnOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('return_status', '<>', 0)->get();
        return view('admin.return-order.list', ['orders' => $orders]);
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
        return view('admin.return-order.show', ['order' => $order]);
    }

    public function changeReturnStatus()
    {

        $order = Order::where('order_id', request('order_id'))->first();
        $order->update(['return_status'=>request('return_status')]);

        return back()->with(['success' => 'Return Status Updated Successfully']);
    }
}
