<?php

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/',[PostController::class,'create'])->name('post#home');
Route::get('customer/createPage',[PostController::class,'create'])->name('post#createPage');
Route::post('post/create',[PostController::class,'postCreate'])->name('post#create');
Route::get('testing',function(){
 return "this is testing";
})->name('test');

// Route::get('post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');
Route::delete('post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');

Route::get('post/updatePage/{id}',[PostController::class,'updatePage'])->name('post#update');
Route::get('post/editPage/{id}',[PostController::class,'editPage'])->name('post#editPage');

Route::post('post/update',[PostController::class,'update'])->name('post#updatePage');
Route::get('product/list',function(){
    $data= Product::select('products.*','categories.name as category_name')
    ->join('categories','products.category_id','categories.id')
    ->get();
    dd($data->toArray());
});

Route::get('order/list',function(){
    $data= Order::get();
    dd($data->toArray());
});

Route::get('example',[PostController::class,'eg'])->name('example');
