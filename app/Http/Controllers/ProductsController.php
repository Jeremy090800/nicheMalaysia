<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import Products Model
use App\Models\Products;

class ProductsController extends Controller
{
    //store function (store product)
    public function store(Request $request){

        //validate and process the request data
        $data = $request->validate([
            'serial_id' => 'required|unique:products',
            'ferrule' => 'required|numeric|between:0,99.9', 
            'length' => 'required|numeric|between:0,99.9',
            'weight' => 'required|numeric|between:0,99.9',
            'butt' => 'required|numeric|between:0,99.9',
            'balancing' => 'required|numeric|between:0,99.9',

        ]);

        //save the product 
        $product = Products::create([
            'serial_id' => $data['serial_id'],
            'ferrule' => $data['ferrule'],
            'length' => $data['length'],
            'weight' => $data['weight'],
            'butt' => $data['butt'],
            'balancing' => $data['balancing'],

        ]);

        //redirect to AddProducts page
        return redirect('/products/create')->with('success', 'Product created successfully!');

    }

    //search funtion (search product)
    public function search(Request $request){

        $serialId = $request->input('serial_id');

        $product = Products::where('serial_id',$serialId)->first();

        return view('SearchProducts', [
            'product' => $product,
            'searchPerformed' => true
        ]);


    }


}



