<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.list', ['brands' => $brands]);
    }

    
    public function create()
    {
        return view('admin.brand.create');
    }


    public function store(Request $request)
    {
      
        
        $this->validateData();

        request()->image->store('brands/');
        Brand::create([
            'name' => request()->name,
            'image' => request()->image->hashName(),
        ]);
        return redirect('brand/index')->with('success', 'Brand created successfully');
    }


    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $brand = Brand::find($id);
        return view('admin.brand.edit', ['brand' => $brand]);
    }

    public function update($id)
    {

        $data = $this->validateData();

        $id = Crypt::decrypt(request()->id);
        $brand = Brand::find($id);
        if (request('image')) {
            Storage::delete('brands/' . $brand->image);
            request()->image->store('brands/');
            $data['image'] = request()->image->hashName();
        }
        $brand->update($data);
        return redirect('brand/index')->with('success', 'Brand updated successfully');
    }
    
    
    
    public function destroy($id)
    {
        $id = Crypt::decrypt(request()->id);
        $brand = Brand::find($id);
        if ($brand->image) {
            Storage::delete('brands/' . $brand->image);
        }

        $brand->delete();
        return redirect('brand/index')->with('success', 'Brand deleted successfully');
    }


    public function validateData()
    {
        return request()->validate(
            [
                'name' => 'required|String',
                'image' => request()->routeIs('brand.update') ? 'nullable|image|max:10000' : 'required|image|max:10000',
            ],
            [
                'name.required' => 'Brand name is required',
                'image.required' => 'Brand image is required',
                'image.image' => 'Brand image must be an image',
                'image.max' => 'Brand image size must be less than 10MB',

            ]

        );
    }
}
