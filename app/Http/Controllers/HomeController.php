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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

     public function index()
    {
        $brands=Brand::all();
        foreach($brands as $brand){
            $brand->image=url(Storage::url('brands/'.$brand->image));
        }

        $productService = new ProductService();
        $trendy_products = $productService->getProducts();
        $shopByCategory = $productService->shopByCategory();
        
        return view('home',['brands'=>$brands,'trendy_products'=>collect($trendy_products),'shopByCategory'=>collect($shopByCategory)]);
    }
}
