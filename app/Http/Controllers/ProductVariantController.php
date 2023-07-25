<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductVariantController extends Controller
{
    public function index($product_id)
    {
        $product_id = Crypt::decrypt($product_id);
        $product = Product::with('variants')->find($product_id);
        
        return view('admin.product-variant.list', ['product_variants' => $product['variants'], 'product_id' => $product_id, 'product_name' => $product['name']]);
    }


    public function create($product_id)
    {
        $product_id = Crypt::decrypt($product_id);
        $product_attributes = ProductAttribute::pluck(DB::raw("CONCAT(name, ' - ', value) AS name"),'id');

        return view('admin.product-variant.create',['product_attributes'=>$product_attributes,'product_id'=>$product_id]);
    }


    public function store()
    {
       
        $this->validateData();

        if (request()->image) {
            request()->image->store('product-variant-image/');
        }
        $product_variant=ProductVariant::create([
            'product_id' => Crypt::decrypt(request()->product_id),
            'product_attribute_id' => json_encode(request()->product_attribute_id),
            'name' => request()->name,
            'price' => request()->price,
            'quantity' => request()->quantity,
            'image' => request('image')?request()->image->hashName():"",
        ]);
        return redirect('product-variant/index/'.request()->product_id)->with('success', 'Product variant created successfully');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $product_attributes = ProductAttribute::pluck(DB::raw("CONCAT(name, ' - ', value) AS name"),'id');
        $product_variant = ProductVariant::find($id);
        
        return view('admin.product-variant.edit', ['product_variant' => $product_variant,'product_attributes'=>$product_attributes,'product_id'=>$product_variant['product_id'],'product_name'=>$product_variant['name']]);
    }


    public function update($id)
    {
        $data = $this->validateData();
        $id = Crypt::decrypt(request()->id);
        $product_variant = ProductVariant::find($id);
        if (request()->image) {
            if($product_variant->image){
                Storage::delete('product-variant-image/' . $product_variant->image);
            }

            request()->image->store('product-variant-image/');
            $data['image'] = request()->image->hashName();
        }

        $data['product_attribute_id'] = json_encode(request()->product_attribute_id);
        

        $product_variant->update($data);
        return redirect('product-variant/index/'.Crypt::encrypt($product_variant->product_id))->with('success', 'Product variant updated successfully');
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt(request()->id);
        $product_variant = ProductVariant::find($id);
        if ($product_variant->image) {
            Storage::delete('product-variant-image/' . $product_variant->image);
        }
        $product_variant->delete();
        return back()->with('success', 'Product variant deleted successfully');
    }


    public function validateData()
    {
        return request()->validate(
            [

                'product_id' => request()->routeIs('product-variant.store')?'required|string':'nullable|string',
                'product_attribute_id.*' => 'required|string',
                'name' => 'nullable|string',
                'price' => 'required|string',
                'quantity' => 'required|string',
                'image' => 'nullable|image|max:10000',
            ],
            [
                'product_id.required' => 'Product Id is required',
                'product_attribute_id.required' => 'Product Attribute Id is required',
                'name.required' => 'Product variant name is required',
                'price.required' => 'Product variant price is required',
                'quantity.required' => 'Product variant quantity is required',
                'product_id.int' => 'Product Id should be string',
                'image.required' => 'Product image is required',
                'image.image' => 'Product image must be an image',
                'image.max' => 'Product Thumbnail must be less than 10MB',

            ]
        );
    }
}
