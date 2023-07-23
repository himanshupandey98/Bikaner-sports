<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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


        category::create([
            'name' => request()->name,

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
            ],
            [
                'name.required' => 'category name is required',


            ]

        );
    }
}
