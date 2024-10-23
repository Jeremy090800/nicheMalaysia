<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


//import Images Model
use App\Models\Images;
//import Products Model
use App\Models\Products;
//import Categories Model
//use App\Models\Categories;
//TESTING PURPOSE
//import Series Model
use App\Models\Series;

class ProductsController extends Controller
{
    // Seller
    // Store function for products
    public function store(Request $request){
        
        // Validate and process the request data for products
        try {
            $data = $request->validate([
                //'category_prefix' => 'required|exists:categories,category_prefix',
                // 'serial_id' => [
                //     'required',
                //     Rule::unique('products')->where(function ($query) use ($request) {
                //         return $query->where('category_prefix', $request->category_prefix);
                //     }),
                // ],

                'warranty_number' => 'required|string|unique:products,warranty_number',
                'serial_id' => 'required|string|unique:products,serial_id',
                //TESTING PURPOSE
                //Add validation for series_id
                'series_id' => 'required|exists:series,series_id',

                'ferrule' => 'required|numeric|between:0,99.9', 
                'length' => 'required|numeric|between:0,99.9',
                'weight' => 'required|numeric|between:0,99.9',
                'butt' => 'required|numeric|between:0,99.9',
                'balancing' => 'required|numeric|between:0,99.9',

                'description' => 'nullable|string',
                'owned_by' => 'nullable|string',
                


                'images' => 'required|array|min:1|max:6',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($e->validator->errors()->has('warranty_number')) {
                return redirect()->back()
                    ->withErrors(['warranty_number' => 'This Warranty Number is already in use'])
                    ->withInput();
            }
            if ($e->validator->errors()->has('serial_id')) {
                return redirect()->back()
                    ->withErrors(['serial_id' => 'This Serial ID is already in use'])
                    ->withInput();
            }
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput(); 
        }

        // Save the product 
        $product = Products::create([
            //'category_prefix' => $data['category_prefix'],
            'warranty_number' => $data['warranty_number'],
            'serial_id' => $data['serial_id'],
            //TESTING PURPOSE
            //ADD THIS LINE TO STORE SERIES_ID
            'series_id' => $data['series_id'],

            'ferrule' => $data['ferrule'],
            'length' => $data['length'],
            'weight' => $data['weight'],
            'butt' => $data['butt'],
            'balancing' => $data['balancing'],
            'description' => $data['description'],
            'owned_by' => $data['owned_by'],
            
            
        ]);

        // handle the image
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imageData = [];
            $fileNames = [];
            $serialId = $data['serial_id'];

            foreach ($images as $index => $image) {
                if ($index >= 6) break; // Limit to 3 images
                $imageData['images_data_' . ($index + 1)] = file_get_contents($image->getRealPath());
                $fileNames['images_file_name_' . ($index + 1)] = $image->getClientOriginalName();
            }

            try {
                DB::beginTransaction();
                
                Images::create(array_merge($imageData, $fileNames, ['serial_id' => $serialId]));

                DB::commit();
                return redirect('/Seller/AddProducts')->with('success', 'Product uploaded successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to upload images: ' . $e->getMessage());
            }
        }

        return redirect('/Seller/AddProducts')->with('success', 'Product created successfully, but no images were uploaded.');
    }


    // // Buyer
    // //search function (search product)
    // public function search(Request $request)
    // {
    //     //$categoryType = $request->input('category_prefix');
    //     $serialId = $request->input('serial_id');
    
    //     // Load the category relationship along with the images
    //     $product = Products::with(['images', 'categories'])
    //         ->where('serial_id', $serialId)
    //         ->whereHas('categories', function ($query) use ($categoryType) {
    //             $query->where('category_prefix', $categoryType);
    //         })
    //         ->first();
    
    //     return view('Buyer.BuyerSearchProducts', [
    //         'product' => $product,
    //         'searchPerformed' => true,
    //         'categoryType' => $categoryType,
    //         'serialId' => $serialId
    //     ]);
    // }

    // public function search(Request $request)
    // {
    //     $serialId = $request->input('serial_id');
    
    //     // Load only the images relationship
    //     $product = Products::with('images')
    //         ->where('serial_id', $serialId)
    //         ->first();
    
    //     return view('Buyer.BuyerSearchProducts', [
    //         'product' => $product,
    //         'searchPerformed' => true,
    //         'serialId' => $serialId
    //     ]);
    // }

    public function search(Request $request)
    {
        // Retrieve the warranty_number from the request input
        $warrantyNumber = $request->input('warranty_number');

        // Load the product by warranty_number and only the images relationship
        $product = Products::with('images')
            ->where('warranty_number', $warrantyNumber)
            ->first();

        // Return the result view with product and search status
        return view('Buyer.BuyerSearchProducts', [
            'product' => $product,
            'searchPerformed' => true,
            'warrantyNumber' => $warrantyNumber
        ]);
    }



    public function fetch_series(){

        $series = Series::all();

        return view('Seller.AddProducts',[
            //'categories' => $categories,
            'series' => $series
        ]);

    }




}