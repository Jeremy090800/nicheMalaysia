<?php

use Illuminate\Support\Facades\Route;

//import UserControlle
use App\Http\Controllers\UserController;
//import ProductsController;
use App\Http\Controllers\ProductsController;

Route::get('/', [UserController::class, 'showForm']);
Route::post('/submit', [UserController::class, 'handleForm']);
Route::get('/result', [UserController::class, 'showResult']);








//return the AddProduct page to the user
Route::get('/products/create', function () {
    return view('AddProducts');
});

//handle the function of store for addproduct
Route::post('/products', [ProductsController::class, 'store']);
