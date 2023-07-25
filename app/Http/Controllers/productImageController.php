<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class productImageController extends Controller
{
    public function index($product_id)
    {
        $product_id = Crypt::decrypt($product_id);
        $product=Product::with('images')->find($product_id);
        // $product_images = ProductImage::where('product_id', $product_id)->get();
        
        return view('admin.product-image.list', ['product_images' => $product['images'], 'product_id' => $product_id,'product_name'=>$product['name']]);
    }


    public function create($product_id)
    {
        $product_id = Crypt::decrypt($product_id);
        return view('admin.product-image.create', ['product_id' => $product_id]);
    }


    public function store()
    {

        
        $this->validateData();

        if(!empty(request()->image)){
            foreach(request()->image as $image){
                $image->store('product-image/');
                $product_image = ProductImage::create([
                    'product_id' => Crypt::decrypt(request()->product_id),
                    'image' => $image->hashName(),
                ]);
            }
        }
       

        return redirect('product-image/index/' . Crypt::encrypt($product_image->product_id))->with('success', 'Product  created successfully');
    }






    public function destroy($id)
    {
        $id = Crypt::decrypt(request()->id);
        $product_image = ProductImage::find($id);
        $product_id = $product_image->product_id;
        if ($product_image->thumbnail) {
            Storage::delete('product-image/' . $product_image->image);
        }
        $product_image->delete();
        return redirect('product-image/index/'.Crypt::encrypt($product_id))->with('success', 'Product image deleted successfully');
    }


    public function validateData()
    {
        return request()->validate(
            [

                'product_id' => 'required|string',
                'image' => 'required|image|max:10000',
            ],
            [
                'product_id.required' => 'Product Id is required',
                'product_id.int' => 'Product Id should be string',
                'image.required' => 'Product image is required',
                'image.image' => 'Product image must be an image',
                'image.max' => 'Product Thumbnail must be less than 10MB',

            ]
        );
    }
}
