<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SportsCategory;
use Illuminate\Support\Facades\Crypt;

class SportsCategoryController extends Controller
{
    public function index()
    {
        $sports_categories = SportsCategory::all();
        return view('admin.sports-category.list', ['sports_categories' => $sports_categories]);
    }


    public function create()
    {
        return view('admin.sports-category.create');
    }


    public function store()
    {

        $this->validateData();


        SportsCategory::create([
            'name' => request()->name,

        ]);
        return redirect('sports-category/index')->with('success', 'Sports category created successfully');
    }


    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $sports_category = SportsCategory::find($id);
        return view('admin.sports-category.edit', ['sports_category' => $sports_category]);
    }

    public function update($id)
    {

        $data = $this->validateData();

        $id = Crypt::decrypt(request()->id);
        $category = SportsCategory::find($id);

        $category->update($data);
        return redirect('sports-category/index')->with('success', 'Sports category updated successfully');
    }



    public function destroy($id)
    {
        $id = Crypt::decrypt(request()->id);
        $category = SportsCategory::find($id);


        $category->delete();
        return redirect('sports-category/index')->with('success', 'Sports category deleted successfully');
    }


    public function validateData()
    {
        return request()->validate(
            [
                'name' => 'required|String',
            ],
            [
                'name.required' => 'Sports category name is required',


            ]

        );
    }

}
