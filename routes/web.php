<?php

use Illuminate\Support\Facades\Route;

/**import UserController**/
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'showForm']);
Route::post('/submit', [UserController::class, 'handleForm']);
Route::get('/result', [UserController::class, 'showResult']);

