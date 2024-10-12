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
                'category_prefix' => 'required|string|max:6|unique:categories,category_prefix',
                'category_name' => 'required|string|max:255',
                'category_description' => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = [];
        
            // Check for category_prefix validation error
            if ($e->validator->errors()->has('category_prefix')) {
                $errors['category_prefix'] = 'This Category Type already exists.';
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
            'category_prefix' => $data['category_prefix'],
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

    //NEWLY ADDED
    //update function
    public function update(Request $request, $category_prefix)
    {
        // Validate the input
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
        ]);
    
        // Find the category by prefix and update it
        $category = Categories::where('category_prefix', $category_prefix)->first();
    
        if ($category) {
            $category->update([
                'category_name' => $request->input('category_name'),
                'category_description' => $request->input('category_description'),
            ]);
            return redirect()->back()->with('success', 'Category updated successfully');
        }
    
        return redirect()->back()->withErrors('Category not found');
    }
    
    //NEWLY ADDED
    //delete function
    public function delete($category_prefix)
    {
        // Find the category by the prefix and delete it
        $category = Categories::where('category_prefix', $category_prefix)->firstOrFail();
    
        // You may want to check for related data before deletion
        // For example, ensure no products are linked to this category.
    
        $category->delete();
    
        // Redirect back to the categories list with a success message
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
    















    
    //functions for store and fetch of categories_sellerdashboard

    public function store_SellerDashboard(Request $request){

        //validate and process the request data for categories
        try {
            $data = $request->validate([
                'category_prefix' => 'required|string|max:6|unique:categories,category_prefix',
                'category_name' => 'required|string|max:255',
                'category_description' => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = [];
        
            // Check for category_prefix validation error
            if ($e->validator->errors()->has('category_prefix')) {
                $errors['category_prefix'] = 'This Category Type already exists.';
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
            'category_prefix' => $data['category_prefix'],
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
