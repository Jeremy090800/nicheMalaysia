<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

//import Products Model
use App\Models\Products;
//import Category Model
use App\Models\Categories;


class CategoriesController extends Controller
{
    // Seller
    // Store function for categories
    public function store(Request $request){

        // Validate and process the request data for categories
        try {
            $data = $request->validate([
                'category_type' => 'required|string|max:6|unique:categories,category_type',
                'category_name' => 'required|string|max:255',
                'category_description' => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = [];
        
            // Check for category_type validation error
            if ($e->validator->errors()->has('category_type')) {
                $errors['category_type'] = 'This Category Type already exists.';
            }
    
            // Check for category_name validation error
            if ($e->validator->errors()->has('category_name')) {
                $errors['category_name'] = 'This Category Name already exists.';
            }

            // If there are any errors, return with the errors and input
            if (!empty($errors)) {
                return redirect()->back()
                    ->withErrors($errors)
                    ->withInput();
            }
    
            // If other errors, throw the exception
            throw $e;
        }

        // Save the category
        $category = Categories::create([
            'category_type' => $data['category_type'],
            'category_name' => $data['category_name'],
            'category_description' => $data['category_description'],
        ]);

        return redirect('/Seller/AddCategories')->with('success', 'Category created successfully.');

    }

    public function fetch_categories(){
        //fetch all categories to dispaly them
        $categories = Categories::all();


        return view('Seller.AddCategories',compact('categories'));
    }

    //functions for store and fetch of categories_sellerdashboard

    public function store_SellerDashboard(Request $request){

        //validate and process the request data for categories
        try {
            $data = $request->validate([
                'category_type' => 'required|string|max:6|unique:categories,category_type',
                'category_name' => 'required|string|max:255',
                'category_description' => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = [];
        
            // Check for category_type validation error
            if ($e->validator->errors()->has('category_type')) {
                $errors['category_type'] = 'This Category Type already exists.';
            }
    
            // Check for category_name validation error
            if ($e->validator->errors()->has('category_name')) {
                $errors['category_name'] = 'This Category Name already exists.';
            }

            // If there are any errors, return with the errors and input
            if (!empty($errors)) {
                return redirect()->back()
                    ->withErrors($errors)
                    ->withInput();
            }
    
            // If other errors, throw the exception
            throw $e;
        }

        // Save the category
        $category = Categories::create([
            'category_type' => $data['category_type'],
            'category_name' => $data['category_name'],
            'category_description' => $data['category_description'],
        ]);

        return redirect('/Seller/AddCategories_SellerDashboard')->with('success', 'Category created successfully.');

    }

    public function fetch_categories_SellerDashboard(){
        //fetch all categories to dispaly them
        $categories = Categories::all();


        return view('Seller.AddCategories_SellerDashboard',compact('categories'));
    }
}
