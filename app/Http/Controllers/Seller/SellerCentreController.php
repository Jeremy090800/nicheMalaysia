<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

// Import Images Model
use App\Models\Images;
// Import Products Model
use App\Models\Products;

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
    
        $SELLER_ID = env('SELLER_ID');
        $SELLER_PASSWORD = env('SELLER_PASSWORD');
    
        if ($request->seller_id === $SELLER_ID && Hash::check($request->password, Hash::make($SELLER_PASSWORD))) {
            // Authentication passed...
            session(['seller_logged_in' => true]);

            // Redirect to a specific page
            return redirect('/Seller/SellerDashboard');
        } 
        
        // else {
        //     // If authentication fails, add a flag to session for failure
        //     session(['auth_success' => false]);
        
        //     return redirect()->back();
        // }
        
    
        return back()->withErrors([
            'login_status' => 'The provided credentials do not match our records.',
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