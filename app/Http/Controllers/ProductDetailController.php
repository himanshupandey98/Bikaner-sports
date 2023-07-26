<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Crypt;

class ProductDetailController extends Controller
{
    public function ProductDetail()
    {
        $product_id = Crypt::decrypt(request()->id);


        $product = Product::with(
            'variants',
            'brand',
            'category',
            'images'
        )
            ->find($product_id);






        $product['sku'] = $product['brand']['name'] . '-' . $product['category']['name'] . '-' . $product['name'];
        foreach ($product['images'] as $key => $image) {
            $product['images'][$key] = url(asset('storage/product-image/' . $image['image']));
        }

        foreach ($product['variants'] as $key => $variant) {
            $variant['image'] = url(asset('storage/product-variant-image/' . $variant['image']));

            $attributes = [];

            foreach (json_decode($variant['product_attribute_id']) as $k1 => $v1) {
                $att = ProductAttribute::select('name', 'value')->find($v1);
                $attributes[$att['name']] = $att['value'];
            }
            $variant['product_attributes'] = $attributes;
        }
       
        return view('product', ['product'=>$product]);



    }
}
