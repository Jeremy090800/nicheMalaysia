<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showForm()
    {
        return view('input');
    }

    public function handleForm(Request $request)
    {
        $input = $request->input('user_input');
        return redirect('/result')->with('user_input', $input);

    }

    public function showResult()
    {
        return view('result');
    }



}