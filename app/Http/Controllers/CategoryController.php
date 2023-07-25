<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.list', ['categories' => $categories]);
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store()
    {

        $this->validateData();


        if (request()->image) {
            request()->image->store('category-image/');
        }
        category::create([
            'name' => request()->name,
            'image' => request()->image ? request()->image->hashName() : null,

        ]);
        return redirect('category/index')->with('success', 'category created successfully');
    }


    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $category = category::find($id);
        return view('admin.category.edit', ['category' => $category]);
    }

    public function update($id)
    {

        $data = $this->validateData();

        $id = Crypt::decrypt(request()->id);
        $category = category::find($id);

        if (request()->image) {
            if($category->image){
                Storage::delete('category-image/'.$category->image);
            }
            request()->image->store('category-image/');
            $data['image'] = request()->image->hashName();
        }
        
        $category->update($data);
        return redirect('category/index')->with('success', 'category updated successfully');
    }



    public function destroy($id)
    {
        $id = Crypt::decrypt(request()->id);
        $category = category::find($id);


        $category->delete();
        return redirect('category/index')->with('success', 'category deleted successfully');
    }


    public function validateData()
    {
        return request()->validate(
            [
                'name' => 'required|String',
                'image'=>request()->routeIs('category.store')?'required|image|max:10000':'nullable|image|max:10000',
            ],
            [
                'name.required' => 'category name is required',
                'name.String' => 'category name must be string',
                'image.required' => 'category image is required',
                'image.image' => 'category image must be image',
                'image.max' => 'category image size must be less than 10MB',


            ]

        );
    }
}
