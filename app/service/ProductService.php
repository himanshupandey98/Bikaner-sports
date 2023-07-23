<?php

namespace App\service;

use App\Models\Product;



class ProductService 
{
    // change
    public function getProducts(){
        $products = Product::all();
        foreach($products as $product){
            $product->sku=$product->brand->name.'-'.$product->category->name;
            $product->thumbnail=url(asset('storage/product-thumbnail/'.$product->thumbnail));
        }

        return $products;
    }
}
