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

class ProductsController extends Controller
{
    // Seller
    // Store function for products
    public function store(Request $request)
    {
        // Validate and process the request data for products
        try {
            $data = $request->validate([
                'serial_id' => [
                    'required',
                    Rule::unique('products'),
                ],
                'ferrule' => 'required|numeric|between:0,99.9', 
                'length' => 'required|numeric|between:0,99.9',
                'weight' => 'required|numeric|between:0,99.9',
                'butt' => 'required|numeric|between:0,99.9',
                'balancing' => 'required|numeric|between:0,99.9',
                'images' => 'required|array|min:1|max:6',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($e->validator->errors()->has('serial_id')) {
                return redirect()->back()
                    ->withErrors(['serial_id' => 'This Serial ID already exists.'])
                    ->withInput();
            }
            throw $e;
        }

        // Save the product 
        $product = Products::create([
            'serial_id' => $data['serial_id'],
            'ferrule' => $data['ferrule'],
            'length' => $data['length'],
            'weight' => $data['weight'],
            'butt' => $data['butt'],
            'balancing' => $data['balancing'],
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
                return redirect('/Seller/AddProducts')->with('success', 'Product and images uploaded successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to upload images: ' . $e->getMessage());
            }
        }

        return redirect('/Seller/AddProducts')->with('success', 'Product created successfully, but no images were uploaded.');
    }


    // Buyer
    //search function (search product)
    public function search(Request $request){

        $serialId = $request->input('serial_id');
        $product = Products::with('images')->where('serial_id', $serialId)->first();

        return view('Buyer.BuyerSearchProducts',[
            'product' => $product,
            'searchPerformed' => true
        ]);

    }


    // Show every picture that exists in the images table
    public function index()
    {
        $images = Images::all();
        return view('index', compact('images'));
    }

    public function show($id)
    {
        $image = Images::findOrFail($id);

        // Get the MIME type
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->buffer($image->images_data);

        // Set headers and return image data
        return response($image->images_data, 200)
                ->header('Content-Type', $mimeType)
                ->header('Content-Disposition', 'inline; filename="' . $image->images_file_name . '"');
    }
}