<?php

use Illuminate\Support\Facades\Route;

//import ProductsController
use App\Http\Controllers\ProductsController;
//import ImageController
use App\Http\Controllers\ImagesController;
//import SellerCentreControler
use App\Http\Controllers\Seller\SellerCentreController;
//import SellerDashboardController
use App\Http\Controllers\Seller\SellerDashboardController;




// Main Page
Route::get('/', function () {
    return view('Main');
});


//SellerCentreLogin Page
Route::get('/Seller/SellerLogin', function() {
    return view('Seller.SellerCentreLogin');
});
//handle the function of login for SellerCentreLogin
Route::post('/Seller/SellerLogin/handle_seller_login_function', [SellerCentreController::class, 'login']);


//SellerDashboard Page
// Route::get('/Seller/SellerDashboard', function() {
//     return view('Seller.SellerDashboard', compact('products'));
// });
Route::get('/Seller/SellerDashboard', [SellerDashboardController::class, 'index']);




//handle the function of logout 
Route::post('/Seller/SellerLogout', [SellerCentreController::class, 'logout']);


//AddProducts page
Route::get('/Seller/AddProducts', function () {
    return view('Seller.AddProducts');
});
//handle the function of store for AddProducts
Route::post('Seller/AddProducts/handle_store_products_function', [ProductsController::class, 'store']);














//show the SearchProduct page to the user
Route::get('/products/search', function () {
    return view('SearchProducts');
});
//handle the function of search for SearchProducts
Route::get('/products/handle_search_products_function', [ProductsController::class, 'search']);






//NEED TO REMOVE VERY SOON
//TESTING PHASE (ImageController)
Route::get('/products/upload_function', function(){
    return view('ImagesProducts');
});
//handle the function of store for ImagesProducts
Route::post('/products/handle_upload_function', [ImagesController::class, 'store']);
//show every pictures inside the image_table
Route::get('/images', [ImagesController::class, 'index'])->name('images.index');
Route::get('/images/{id}', [ImagesController::class, 'show'])->name('images.show');





