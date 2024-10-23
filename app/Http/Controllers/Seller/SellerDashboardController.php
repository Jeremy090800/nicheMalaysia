<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import Images Model
use App\Models\Images;
// Import Products Model
use App\Models\Products;
// Import Series Model
use App\Models\Series;


class SellerDashboardController extends Controller
{
    public function fetch_products()
    {
        // Fetch all products and their associated images using eager loading
        $products = Products::with(['images','series'])->get();
        $series = Series::all();

        // Pass products with their associated images to the SellerDashboard view
        return view('Seller.SellerDashboard', compact('products', 'series'));
    }
}
