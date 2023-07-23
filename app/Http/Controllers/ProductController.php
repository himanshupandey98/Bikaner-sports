<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SportsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.list', ['products' => $products]);
    }


    public function create()
    {
        $brands = Brand::pluck('name','id');
        $categories = Category::pluck('name','id');
        $sports_categories = SportsCategory::pluck('name','id');
        return view('admin.product.create',['brands'=>$brands,'categories'=>$categories,'sports_categories'=>$sports_categories]);
    }


    public function store()
    {
        
        $this->validateData();

        if (request()->thumbnail) {
            request()->thumbnail->store('product-thumbnail/');
        }
        Product::create([
            'name' => request()->name,
            'thumbnail' => request()->thumbnail->hashName(),
            'description' => request()->description,
            'brand_id' => request()->brand_id,
            'sports_category_id' => request()->sports_category_id,
            'category_id' => request()->category_id,
        ]);
        return redirect('product/index')->with('success', 'Product  created successfully');
    }

    public function edit($id)
    {
        $brands = Brand::pluck('name','id');
        $categories = Category::pluck('name','id');
        $sports_categories = SportsCategory::pluck('name','id');
        $id = Crypt::decrypt($id);
        $product = Product::find($id);
        return view('admin.product.edit', ['product' => $product,'brands'=>$brands,'categories'=>$categories,'sports_categories'=>$sports_categories]);
    }


    public function update($id)
    {
        $data = $this->validateData();
        $id = Crypt::decrypt(request()->id);
        $product = Product::find($id);
        if (request()->thumbnail) {
            Storage::delete('product-thumbnail/' . $product->thumbnail);
            request()->thumbnail->store('product-thumbnail/');
            $data['thumbnail'] = request()->thumbnail->hashName();
        }

        $product->update($data);
        return redirect('product/index')->with('success', 'Product  updated successfully');
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt(request()->id);
        $product = Product::find($id);
        if ($product->thumbnail) {
            Storage::delete('product-thumbnail/' . $product->thumbnail);
        }
        $product->delete();
        return redirect('product/index')->with('success', 'Product  deleted successfully');
    }


    public function validateData()
    {
        return request()->validate(
            [
                'name' => 'required|String',
                'brand_id' => 'required|int',
                'sports_category_id' => 'required|int',
                'category_id' => 'required|int',
                'description' => 'required|String',
                'thumbnail' => request()->routeIs('product.store') ? 'required|image|max:10000' : 'nullable|image|max:10000',
            ],
            [
                'name.required' => 'Product Name is required',
                'description.required' => 'Product Description is required',
                'thumbnail.required' => 'Product Thumbnail is required',
                'thumbnail.image' => 'Product Thumbnail must be an image',
                'thumbnail.max' => 'Product Thumbnail must be less than 10MB',
                'brand_id.required' => 'Brand is required',
                'sports_category_id.required' => 'Sports Category is required',
                'category_id.required' => 'Category is required',
            ]
        );
    }
}
