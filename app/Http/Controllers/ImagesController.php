<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

//import Images Model
use App\Models\Images;


use Illuminate\Suppoprt\Facades\Log;


class ImagesController extends Controller
{
    
    public function store(Request $request){

        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imageData = file_get_contents($image->getRealPath());
            
            Images::create([
                'images_name' => $imageName,
                'images_data' => $imageData,
            ]);

            return redirect()->back()->with('success', 'Image uploaded succesfully.');
        
        }

        return redirect()->back()->with('error', 'Failed to upload image');
        
    }

    //show every pictures that exist in the images_table
    public function index(){
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
                ->header('Content-Disposition', 'inline; filename="' . $image->images_name . '"');

    }
    
    





}
