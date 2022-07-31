<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UnionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function(){  


Route::resource('/category', CategoryController::class);
Route::resource('/product', ProductController::class);
Route::get('/singleproduct/{id}', [ProductController::class, 'singleproduct'])->name('product.singleproduct');
Route::get('/category_product/{id}', [ProductController::class, 'category_product'])->name('product.category_product');

Route::get('/frontpage', [FrontendController::class, 'frontpage'])->name('frontpage');

Route::resource('/cart', CartController::class);

Route::resource('/checkout', CheckoutController::class);

Route::get('/unions', [UnionController::class, 'index'])->name('unions.index');
Route::get('create/unions', [UnionController::class, 'index']);
Route::get('get-district-list', [UnionController::class, 'getDistrictList']);
Route::get('get-thana-list', [UnionController::class, 'getThanaList']);
Route::get('get-union-list', [UnionController::class, 'getUnionList']);
  
});
