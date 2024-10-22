<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import Series Model
use App\Models\Series;

class SeriesController extends Controller
{
    //fetch all the existing series to the AddSeries Page
    public function fetch_series(){
        $series = Series::all();

        return view('Seller.AddSeries',compact('series'));
    }

    //store function for Series
    public function store(Request $request){

        // Validate and process the request data for categories
        try {
            $data = $request->validate([
                'series_name' => 'required|string|max:255|unique:series,series_name',
                'series_description' => 'nullable|string|max:16383',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = [];
        
            // Check for category_prefix validation error
            if ($e->validator->errors()->has('series_name')) {
                $errors['series_name'] = 'This Series Name already exists.';
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
        Series::create([
            'series_name' => $data['series_name'],
            'series_description' => $data['series_description'],
        ]);

        return redirect('/Seller/AddSeries')->with('success', 'Series created successfully.');

    }


    //NEWLY ADDED
    //update function
    public function update(Request $request, $seriesId)
    {
        $series = Series::findOrFail($seriesId);

        try {
            $data = $request->validate([
                'series_name' => 'required|string|max:255|unique:series,series_name,' . $seriesId . ',series_id',
                'series_description' => 'nullable|string|max:16383',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $series->update($data);

        //return response()->json(['message' => 'Series updated successfully.']);
        return redirect()->back()->with('success', 'Category updated successfully');
    }

    //NEWLY ADDED
    //delete function
    public function delete($seriesId)
    {
        // Find the series by the id and delete it
        $series = Series::where('series_id', $seriesId)->firstOrFail();

        // You may want to check for related data before deletion
        // For example, ensure no products are linked to this series.

        $series->delete();

        // Redirect back to the series list with a success message
        return redirect()->back()->with('success', 'Series deleted successfully!');
    }






}
