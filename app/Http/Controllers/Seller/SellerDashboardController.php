<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import Images Model
use App\Models\Images;
// Import Products Model
use App\Models\Products;

class SellerDashboardController extends Controller
{
    public function index()
    {
        // Fetch all products and their associated images using eager loading
        $products = Products::with('images')->get(); // Eager load the 'images' relationship

        // If no products are found, return an empty collection (this part can be simplified)
        if ($products->isEmpty()) {
            $products = collect();
        }

        // Pass products with their associated images to the SellerDashboard view
        return view('Seller.SellerDashboard', compact('products'));
    }
}
