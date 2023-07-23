<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Crypt;

class ProductAttributeController extends Controller
{
    public function index()
    {
        $product_attributes = ProductAttribute::all();
        return view('admin.product-attribute.list', ['product_attributes' => $product_attributes]);
    }


    public function create()
    {
        return view('admin.product-attribute.create');
    }


    public function store()
    {
        $this->validateData();
        ProductAttribute::create([
            'name' => request()->name,
            'value' => request()->value,
        ]);
        return redirect('product-attribute/index')->with('success', 'Product Attribute created successfully');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $product_attribute = ProductAttribute::find($id);
        return view('admin.product-attribute.edit', ['product_attribute' => $product_attribute]);
    }


    public function update($id)
    {
        $data = $this->validateData();
        $id = Crypt::decrypt(request()->id);
        $product_attribute = ProductAttribute::find($id);
        $product_attribute->update($data);
        return redirect('product-attribute/index')->with('success', 'Product Attribute updated successfully');
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt(request()->id);
        $product_attribute = ProductAttribute::find($id);
        $product_attribute->delete();
        return redirect('product-attribute/index')->with('success', 'Product attribute deleted successfully');
    }


    public function validateData()
    {
        return request()->validate(
            [
                'name' => 'required|String',
                'value' => 'required|String',
            ],
            [
                'name.required' => 'Product attribute  name is required',
                'value.required' => 'Product attribute  value is required',
            ]
        );
    }

}















