<?php

namespace App\service;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;



class ProductService 
{
    
    public function getProductVariants(){
        $product_variants = ProductVariant::with('product', 'product.brand', 'product.category')->get();
        
        $data=[];
        foreach($product_variants as $key=>$product){
            $data[$key]['product_variant_id']=$product['id'];
            $data[$key]['product_id']=$product['product_id'];
            $data[$key]['sku']=$product['product']['brand']['name'].'-'.$product['product']['category']['name'].'-'.$product['name'];
            $data[$key]['thumbnail']=url(asset('storage/product-thumbnail/'.$product['product']['thumbnail']));
            $data[$key]['image']=url(asset('storage/product-variant-image/'.$product['image']));
            $data[$key]['price']='Rs.'.$product['price'].'/-';
        }

        return $data;
    }


    public function shopByCategory(){
        $categories = Category::latest()->limit(4)->get();
        $data=[];
        foreach($categories as $key=>$cat){
            $data[$key]['id']=$cat['id'];
            $data[$key]['name']=$cat['name'];
            $data[$key]['image']=url(asset('storage/category-image/'.$cat->image));
           
        }

        return $data;
    }
}
