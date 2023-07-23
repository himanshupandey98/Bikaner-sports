<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\SportsCategoryController;
use App\Http\Controllers\ProductAttributeController;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/admin', function () {
    return view('admin');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('brand/index', [BrandController::class,'index'])->name('brand.index');
Route::get('brand/create', [BrandController::class,'create'])->name('brand.create');
Route::post('brand/store', [BrandController::class,'store'])->name('brand.store');
Route::get('brand/edit/{id}', [BrandController::class,'edit'])->name('brand.edit');
Route::post('brand/update/{id}', [BrandController::class,'update'])->name('brand.update');
Route::get('brand/destroy/{id}', [BrandController::class,'destroy'])->name('brand.destroy');



Route::get('category/index', [CategoryController::class,'index'])->name('category.index');
Route::get('category/create', [CategoryController::class,'create'])->name('category.create');
Route::post('category/store', [CategoryController::class,'store'])->name('category.store');
Route::get('category/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
Route::post('category/update/{id}', [CategoryController::class,'update'])->name('category.update');
Route::get('category/destroy/{id}', [CategoryController::class,'destroy'])->name('category.destroy');



Route::get('sports-category/index', [SportsCategoryController::class,'index'])->name('sports-category.index');
Route::get('sports-category/create', [SportsCategoryController::class,'create'])->name('sports-category.create');
Route::post('sports-category/store', [SportsCategoryController::class,'store'])->name('sports-category.store');
Route::get('sports-category/edit/{id}', [SportsCategoryController::class,'edit'])->name('sports-category.edit');
Route::post('sports-category/update/{id}', [SportsCategoryController::class,'update'])->name('sports-category.update');
Route::get('sports-category/destroy/{id}', [SportsCategoryController::class,'destroy'])->name('sports-category.destroy');



Route::get('product-attribute/index', [ProductAttributeController::class,'index'])->name('product-attribute.index');
Route::get('product-attribute/create', [ProductAttributeController::class,'create'])->name('product-attribute.create');
Route::post('product-attribute/store', [ProductAttributeController::class,'store'])->name('product-attribute.store');
Route::get('product-attribute/edit/{id}', [ProductAttributeController::class,'edit'])->name('product-attribute.edit');
Route::post('product-attribute/update/{id}', [ProductAttributeController::class,'update'])->name('product-attribute.update');
Route::get('product-attribute/destroy/{id}', [ProductAttributeController::class,'destroy'])->name('product-attribute.destroy');




Route::get('product/index', [ProductController::class,'index'])->name('product.index');
Route::get('product/create', [ProductController::class,'create'])->name('product.create');
Route::post('product/store', [ProductController::class,'store'])->name('product.store');
Route::get('product/edit/{id}', [ProductController::class,'edit'])->name('product.edit');
Route::post('product/update/{id}', [ProductController::class,'update'])->name('product.update');
Route::get('product/destroy/{id}', [ProductController::class,'destroy'])->name('product.destroy');