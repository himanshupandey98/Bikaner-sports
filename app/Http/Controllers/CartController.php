<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    private function fetchItems()
    {
        $cart = Cart::with(['variant' => function ($query) {
            $query->select('id', 'image', 'price');
        }])->where('order_id',NULL)->get();
        $data = [];
        foreach ($cart as $key => $item) {
            $data[$key]['id'] = $item['id'];
            $data[$key]['product_image'] = url(Storage::url('product-variant-image/' . $item['variant']['image']));
            $data[$key]['product_sku'] = $item['product_sku'];
            $data[$key]['product_price'] = $item['variant']['price'];
            $data[$key]['product_qty'] = $item['product_qty'];
            $data[$key]['order_id'] = $item['order_id'];
            
        }

        return $data;
    }




    public function showCart()
    {

        return view('cart');
    }
    public function addToCart()
    {
        request()->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required',
            'product_sku' => 'required'
        ]);
        try {

            Cart::create([

                'product_variant_id' => request()->product_variant_id,
                'product_qty' => request()->quantity,
                'product_sku' => request()->product_sku,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully',
                'data' => $this->fetchItems()

            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'data' => $th->getMessage()
            ]);
        }
    }

    public function updateCartQuantity()
    {
        request()->validate([
            'id' => 'required|exists:carts,id',
            'qty' => 'required'
        ]);
        try {
            Cart::where('id', request()->id)->update([
                'product_qty' => request()->qty
            ]);
            $data = $this->fetchItems();
            return response()->json([
                'status' => 'success',
                'message' => 'Cart item quantity updated successfully',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'data' => $th->getMessage()
            ]);
        }
    }



    public function getCartItems()
    {
        $data = $this->fetchItems();
        return response()->json([
            'status' => 'success',
            'message' => 'Cart items fetched successfully',
            'data' => $data
        ]);
    }


    public function deleteCartItem()
    {
        request()->validate([
            'id' => 'required|exists:carts,id'
        ]);
        try {
            Cart::where('id', request()->id)->delete();
            $data = $this->fetchItems();
            return response()->json([
                'status' => 'success',
                'data' => $data,
                'message' => 'Cart item deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'data' => $th->getMessage()
            ]);
        }
    }
}
