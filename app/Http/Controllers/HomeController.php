<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\service\ProductService;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $brands=Brand::all();
        foreach($brands as $brand){
            $brand->image=url(Storage::url('brands/'.$brand->image));
        }

        $productService = new ProductService();
        $trendy_products = $productService->getProducts();

        return view('home',['brands'=>$brands,'trendy_products'=>$trendy_products]);
    }
}