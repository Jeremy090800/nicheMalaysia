<?php

use Illuminate\Support\Facades\Route;

//import UserControlle
use App\Http\Controllers\UserController;
//import ProductsController;
use App\Http\Controllers\ProductsController;



//the main page
Route::get('/', function () {
    
    return view('Main');

});



//testing page
Route::get('/showForm', [UserController::class, 'showForm']);
Route::post('/submit', [UserController::class, 'handleForm']);
Route::get('/result', [UserController::class, 'showResult']);


//AddProduct function page
//return the AddProduct page to the user
Route::get('/products/create', function () {
    return view('AddProducts');
});
//handle the function of store for AddProduct
Route::post('products/handle_store_products_function', [ProductsController::class, 'store']);



//SearchProduct function page
//show the SearchProduct page to the user
Route::get('/products/search', function () {
    return view('SearchProducts');
});
//handle the function of search for SearchProduct
Route::get('/products/handle_search_products_function', [ProductsController::class, 'search']);

