<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/login', function () {
//     return view('login');
// })->name('pagelogin');
// Route::get('/profile', function () {
//     return view('profile') ;
// })->name('pageprofile');

// Route::get('/contact', function () {
//     return view('user.contact') ;
// })->name('pagecontact');

Route::get('/pagedataforprocess', function () {
    return view('user.page_data_process') ;
})->name('pageprocess');

Route::get('/pagedataforproject', function () {
    return view('user.page_data_project') ;
})->name('pageproject');

Route::get('/pagelogin', function () {
    return view('login') ;
})->name('pagelogin');

Route::get('/', [UserController::class, 'show'])->name('pageindex');
// Route::get('/form', [UserController::class, 'showform'])->name('pageform');
// Route::post('/nextform', [UserController::class, 'shownextform']);


// Route::get('/Admin', [AdminController::class, 'showAdmin']);
