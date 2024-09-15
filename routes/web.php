<?php

use Illuminate\Support\Facades\Route;

//import ProductsController
use App\Http\Controllers\ProductsController;
//import SellerCentreControler
use App\Http\Controllers\Seller\SellerCentreController;
//import SellerDashboardController
use App\Http\Controllers\Seller\SellerDashboardController;


// Main
Route::get('/', function () {
    return view('Main');
});


//SellerCentreLogin
Route::get('/Seller/SellerLogin', function() {
    return view('Seller.SellerCentreLogin');
});
Route::post('/Seller/SellerLogin/handle_seller_login_function', [SellerCentreController::class, 'login']);




//SellerDashboard
Route::get('/Seller/SellerDashboard', [SellerDashboardController::class, 'index']);
//SellerLogout
Route::post('/Seller/SellerLogout', [SellerCentreController::class, 'logout']);
//AddProducts
Route::get('/Seller/AddProducts', function () {
    return view('Seller.AddProducts');
});
Route::post('Seller/AddProducts/handle_store_products_function', [ProductsController::class, 'store']);
//Buyer Products Search
Route::get('/Buyer/BuyerSearchProducts', function () {
    return view('Buyer.BuyerSearchProducts');
});
Route::get('/Buyer/BuyerSearchProducts/handle_search_products_function', [ProductsController::class, 'search']);
