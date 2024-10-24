<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Seller\SellerCentreController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SeriesController;
use App\Models\Images;
use App\Models\Products;
use App\Models\Sellers;
use App\Models\Series;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

// Main
Route::get('/', function () {
    return view('Main');
});

// Temporary route for about page
Route::get('/about', function () {
    return view('main'); // Or create a new view when ready
});

// Temporary route for contact page
Route::get('/contact', function () {
    return view('main'); // Or create a new view when ready
});

//--------------------------------SELLER---------------------------------------------------------------------------------------------------------

// SellerCentreLogin
Route::get('/Seller/SellerLogin', function() {
    return view('Seller.SellerCentreLogin');
});
Route::post('/Seller/SellerLogin/handle_seller_login_function', [SellerCentreController::class, 'login']);

// SellerDashboard
Route::get('/Seller/SellerDashboard', [SellerDashboardController::class, 'fetch_products']);

// SellerLogout
Route::post('/Seller/SellerLogout', [SellerCentreController::class, 'logout']);

// AddProducts
Route::get('/Seller/AddProducts', [ProductsController::class, 'fetch_series']);
Route::post('Seller/AddProducts/handle_store_products_function', [ProductsController::class, 'store']);

//--------------------------------BUYER---------------------------------------------------------------------------------------------------------

// Buyer Products Search
Route::get('/Buyer/BuyerSearchProducts', function () {
    return view('Buyer.BuyerSearchProducts');
});
Route::get('/Buyer/BuyerSearchProducts/handle_search_products_function', [ProductsController::class, 'search']);

//-----------------TESTING----------------------
// Update CATEGORY
Route::post('Seller/UpdateCategories/{category_prefix}', [CategoriesController::class, 'update']);
// Delete Category
Route::delete('Seller/DeleteCategory/{category_prefix}', [CategoriesController::class, 'delete']);

// Add Series
Route::get('/Seller/AddSeries', [SeriesController::class, 'fetch_series']);
Route::post('/Seller/AddSeries/handle_store_series_function', [SeriesController::class, 'store']);
Route::post('/Seller/UpdateSeries/{seriesId}', [SeriesController::class, 'update']);
Route::delete('/Seller/DeleteSeries/{seriesId}', [SeriesController::class, 'delete']);

//--------------------------------SITEMAP--------------------------------------------------------------------------------------------------------- 

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();

    // Add static pages
    $sitemap->add(Url::create('/')->setPriority(1.0))
            ->add(Url::create('/about')->setPriority(0.8))
            ->add(Url::create('/contact')->setPriority(0.8));

    // Add dynamic pages like products from the database
    $products = Products::all(); // Ensure you use the correct model reference
    foreach ($products as $product) {
        $sitemap->add(Url::create("/products/{$product->slug}")->setPriority(0.9));
    }

    // Add dynamic pages from the Series model
    $series = Series::all();
    foreach ($series as $serie) {
        $sitemap->add(Url::create("/series/{$serie->slug}")->setPriority(0.7));
    }
    return response($sitemap->render(), 200)
    ->header('Content-Type', 'application/xml');

});
