<?php

use Illuminate\Support\Facades\Route;


//import ProductsController
use App\Http\Controllers\ProductsController;
//import ImageController
use App\Http\Controllers\ImagesController;


//the main page
Route::get('/', function () {
    return view('Main');
});


//AddProduct function page (ProductsController)
//return the AddProduct page to the user
Route::get('/products/create', function () {
    return view('AddProducts');
});
//handle the function of store for AddProducts
Route::post('products/handle_store_products_function', [ProductsController::class, 'store']);
//show the SearchProduct page to the user
Route::get('/products/search', function () {
    return view('SearchProducts');
});
//handle the function of search for SearchProducts
Route::get('/products/handle_search_products_function', [ProductsController::class, 'search']);



//TESTING PHASE (ImageController)
Route::get('/products/upload_function', function(){
    return view('ImagesProducts');
});
//handle the function of store for ImagesProducts
Route::post('/products/handle_upload_function', [ImagesController::class, 'store']);
//show every pictures inside the image_table
Route::get('/images', [ImagesController::class, 'index'])->name('images.index');
Route::get('/images/{id}', [ImagesController::class, 'show'])->name('images.show');