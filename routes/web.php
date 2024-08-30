<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', function () {
    return view('login');
})->name('pagelogin');
Route::get('/profile', function () {
    return view('profile') ;
})->name('pageprofile');

Route::get('/contact', function () {
    return view('user.contact') ;
})->name('pagecontact');


Route::get('/', [UserController::class, 'show']);
Route::get('/form', [UserController::class, 'showform'])->name('pageform');
Route::post('/nextform', [UserController::class, 'shownextform']);


Route::get('/Admin', [AdminController::class, 'showAdmin']);
