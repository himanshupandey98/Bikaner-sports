<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\productImageController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\SportsCategoryController;
use App\Http\Controllers\ProductAttributeController;

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/product-detail',[ProductDetailController::class,'ProductDetail']);
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


Route::get('customer-orders', [OrderController::class,'customerOrders']);
Route::get('order/index', [OrderController::class,'index'])->name('order.index');
Route::get('order/create', [OrderController::class,'create'])->name('order.create');
Route::post('order/store', [OrderController::class,'store'])->name('order.store');
Route::get('order/edit/{id}', [OrderController::class,'edit'])->name('order.edit');
Route::get('order/show/{id}', [OrderController::class,'show'])->name('order.show');
Route::get('change-order-status', [OrderController::class,'changeOrderStatus']);
Route::get('fetch-order-status', [OrderController::class,'fetchOrderStatus']);

Route::post('order/update/{id}', [OrderController::class,'update'])->name('order.update');
Route::get('order/destroy/{id}', [OrderController::class,'destroy'])->name('order.destroy');



Route::get('product-image/index/{product_id}', [productImageController::class,'index'])->name('product-image.index');
Route::get('product-image/create/{product_id}', [productImageController::class,'create'])->name('product-image.create');
Route::post('product-image/store', [productImageController::class,'store'])->name('product-image.store');
Route::get('product-image/destroy/{id}', [productImageController::class,'destroy'])->name('product-image.destroy');



Route::get('product-variant/index/{product_id}', [ProductVariantController::class,'index'])->name('product-variant.index');
Route::get('product-variant/create/{product_id}', [ProductVariantController::class,'create'])->name('product-variant.create');
Route::post('product-variant/store', [ProductVariantController::class,'store'])->name('product-variant.store');
Route::get('product-variant/edit/{id}', [ProductVariantController::class,'edit'])->name('product-variant.edit');
Route::post('product-variant/update/{id}', [ProductVariantController::class,'update'])->name('product-variant.update');
Route::get('product-variant/destroy/{id}', [ProductVariantController::class,'destroy'])->name('product-variant.destroy');


Route::post('add-to-cart',[CartController::class,'addToCart'])->name('add-to-cart');
Route::get('get-cart-items',[CartController::class,'getCartItems'])->name('get-cart-items');
Route::post('delete-cart-item',[CartController::class,'deleteCartItem'])->name('delete-cart-item');
Route::post('update-cart-quantity',[CartController::class,'updateCartQuantity'])->name('update-cart-quantity');
Route::get('show-cart',[CartController::class,'showCart'])->name('show-cart');



Route::get('checkout-page',[CheckoutController::class,'checkoutPage']);
Route::post('razorpay-order',[PaymentController::class,'RazorpayOrder']);
Route::get('razorpay-payment',[PaymentController::class,'RazorpayPayment']);

Route::post('get-order-for-payment',[OrderController::class,'getOrderForPayment']);
Route::post('make-payment',[PaymentController::class,'makePayment']);
Route::get('invoice',[PaymentController::class,'invoice']);