<?php

use Illuminate\Support\Facades\Route;

//import ProductsController
use App\Http\Controllers\ProductsController;
//import SellerCentreController
use App\Http\Controllers\Seller\SellerCentreController;
//import SellerDashboardController
use App\Http\Controllers\Seller\SellerDashboardController;
//import CategoriesController
use App\Http\Controllers\CategoriesController;


// Main
Route::get('/', function () {
    return view('Main');
});

//--------------------------------SELLER---------------------------------------------------------------------------------------------------------

//SellerCentreLogin
Route::get('/Seller/SellerLogin', function() {
    return view('Seller.SellerCentreLogin');
});
Route::post('/Seller/SellerLogin/handle_seller_login_function', [SellerCentreController::class, 'login']);

//SellerDashboard
Route::get('/Seller/SellerDashboard', [SellerDashboardController::class, 'fetch_products']);
//SellerLogout
Route::post('/Seller/SellerLogout', [SellerCentreController::class, 'logout']);

//AddProducts
Route::get('/Seller/AddProducts', [ProductsController::class, 'fetch_categories']);
Route::post('Seller/AddProducts/handle_store_products_function', [ProductsController::class, 'store']);

//AddCategories
Route::get('/Seller/AddCategories', [CategoriesController::class, 'fetch_categories']);
Route::post('/Seller/AddCategories/handle_store_categories_function', [CategoriesController::class, 'store']);
//AddCategories_SellerDashboard
Route::get('/Seller/AddCategories_SellerDashboard',[CategoriesController::class, 'fetch_categories_SellerDashboard']);
Route::post('/Seller/AddCategories_SellerDashboard/handle_store_categories_function', [CategoriesController::class, 'store_SellerDashboard']);

//--------------------------------BUYER---------------------------------------------------------------------------------------------------------

//Buyer Products Search
Route::get('/Buyer/BuyerSearchProducts', function () {
    return view('Buyer.BuyerSearchProducts');
});
Route::get('/Buyer/BuyerSearchProducts/handle_search_products_function', [ProductsController::class, 'search']);



//-----------------TESTING----------------------
//CATEGORY ADD
Route::post('Seller/UpdateCategories/{category_prefix}', [CategoriesController::class, 'update']);

