<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Import Images Model
use App\Models\Images;
// Import Products Model
use App\Models\Products;
//NEWLY ADDED
//Import the Sellers Model
use App\Models\Sellers;

class SellerCentreController extends Controller
{
    // Login function from SellerCentreLogin.blade.php
    public function login(Request $request)
    {        
        // Validate the request
        $request->validate([
            'seller_id' => 'required',
            'password' => 'required',
        ]);

        //Fetch the seller record from the database
        $seller = Sellers::where('seller_id', $request->seller_id)->first();

    
        // Check if seller exists and if the password matches
        if ($seller && Hash::check($request->password, $seller->password)) {
            // Authentication passed...
            session(['seller_logged_in' => true]);

            // Redirect to a specific page (Seller Dashboard)
            return redirect('/Seller/SellerDashboard');
        }

        return back()->withErrors([
            'login_status' => 'Seller ID or password mismatch.',
        ]);
    }

    // Logout function
    public function logout(Request $request)
    {
        // Clear the session
        $request->session()->forget('seller_logged_in');

        // Optionally, you can regenerate the session to prevent session fixation
        $request->session()->regenerate();

        // Redirect to login page or another page
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }






}