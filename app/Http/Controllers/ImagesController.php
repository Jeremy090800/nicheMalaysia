<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

// Import Images Model
use App\Models\Images;

class ImagesController extends Controller
{
    public function store(Request $request)
    {
        // Validate the uploaded files
        $request->validate([
            'images' => 'required|array|min:1|max:6',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            
            $imageData = [];
            $fileNames = [];
    
            foreach ($images as $index => $image) {
                if ($index >= 6) break; // Limit to 6 images
                $imageData['images_data_' . ($index + 1)] = file_get_contents($image->getRealPath());
                $fileNames['images_file_name_' . ($index + 1)] = $image->getClientOriginalName();
            }
            
            try {
                DB::beginTransaction();
    
                Images::create(array_merge($imageData, $fileNames));
    
                DB::commit();
                return redirect()->back()->with('success', 'Images uploaded successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to upload images: ' . $e->getMessage());
            }
        }
    
        return redirect()->back()->with('error', 'No images were uploaded');
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