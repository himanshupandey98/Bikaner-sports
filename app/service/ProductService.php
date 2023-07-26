<?php

namespace App\service;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;



class ProductService
{

    public function getProducts()
    {
        $products = Product::has('variants')
            ->with(['variants' => function ($query) {
                $query->select('product_id', DB::raw('MIN(price) as min_price'), DB::raw('MAX(price) as max_price'))
                    ->groupBy('product_id');
            }, 'brand' => function ($query) {
                $query->select('id', 'name');
            }, 'category' => function ($query) {
                $query->select('id', 'name');
            }])
            ->get();
        

        $data = [];
        foreach ($products as $key => $product) {
           
           
            $data[$key]['sku'] = $product['brand']['name'] . '-' . $product['category']['name'] . '-' . $product['name'];
            $data[$key]['thumbnail'] = url(asset('storage/product-thumbnail/' . $product['thumbnail']));
            
            $data[$key]['price'] = $product['variants'][0]['min_price']!=$product['variants'][0]['max_price']?'Rs.'.$product['variants'][0]['min_price'].' - '.$product['variants'][0]['max_price'].'/-':'Rs.'.$product['variants'][0]['max_price'].'/-';
            $data[$key]['product_url'] = url('product-detail/?id=' . Crypt::encrypt($product['id']));
        }

        return $data;
    }


    public function shopByCategory()
    {
        $categories = Category::latest()->limit(4)->get();
        $data = [];
        foreach ($categories as $key => $cat) {
            $data[$key]['id'] = $cat['id'];
            $data[$key]['name'] = $cat['name'];
            $data[$key]['image'] = url(asset('storage/category-image/' . $cat->image));
        }

        return $data;
    }
}
