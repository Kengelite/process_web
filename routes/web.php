<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [UserController::class, 'show']);
Route::get('/form', [UserController::class, 'showform']);

Route::get('/Admin', [AdminController::class, 'showAdmin']);
