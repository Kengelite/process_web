<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckUserRole;
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

// Route::get('/pagedataforprocess', function () {
//     return view('user.page_data_process') ;
// })->name('pageprocess');

// Route::get('/pagedataforproject', function () {
//     return view('user.page_data_project') ;
// })->name('pageproject');

// Route::get('/pagedataforproduct', function () {
//     return view('user.page_data_product') ;
// })->name('pageproduct');


// Route::get('/pagedataforemployee', function () {
//     return view('user.employee') ;
// })->name('pageemployee');

// Route::get('/pagedataforteacher', function () {
//     return view('user.teacher') ;
// })->name('pageteacher');

Route::get('/pagelogin', function () {
    return view('login') ;
})->name('pagelogin');

Route::get('/pageout', function () {
    session()->flush();
    session()->regenerateToken();
    return view('login') ;
})->name('pageout');


Route::middleware([CheckUserRole::class])->group(function () {
    Route::get('/secure-page', function () {
        return view('login') ;
    });
    Route::get('/pageselectdata_get/{id}', [UserController::class, 'selectshowdata_get'])->name('pageselectdata_get');
Route::post('/pageselectdata_get/{id}/edit_data', [UserController::class, 'edit_number_controller'])->name('postedit_id_number');
Route::post('/pageselectdata_get/{id}/edit_data/getdata_year', [UserController::class, 'get_data_year'])->name('postget_data_year');
Route::post('/pageselectdata_get/{id}/edit_data/getdata_cotton', [UserController::class, 'get_data_cotton'])->name('postget_data_cotton');
Route::post('/pageselectdata_get/{id}/edit_data/getdata_type', [UserController::class, 'get_data_type'])->name('postget_data_type');
Route::post('/pageselectdata_get/{id}/edit_data/getdata_teachers', [UserController::class, 'get_data_teachers'])->name('postget_data_teachers');
Route::post('/pageselectdata_get/{id}/edit_data/getdata_employee', [UserController::class, 'get_data_employee'])->name('postget_data_employee');
Route::post('/pageselectdata_get/{id}/edit_data/upload', [UserController::class, 'uploadFile'])->name('upload.file');
Route::post('/pageselectdata_get/{id}/edit_data/change_status', [UserController::class, 'changeStatus'])->name('changeStatusbtn');

Route::get('/pageselectdata_get/documents/create', [UserController::class, 'create_process'])->name('documents.create');
Route::post('/pageselectdata_get/documents/store', [UserController::class, 'store_process'])->name('documents.store');
Route::post('/pageselectdata_get/documents/addnew_data_create', [UserController::class, 'add_data_new_DB'])->name('postadd.createprocess');


Route::get('/pagedataforteacher/teachers/create', [UserController::class, 'create_teacher'])->name('teachers-add');
Route::post('/pagedataforteacher/teachers/store', [UserController::class, 'store_teacher']);
Route::get('/pagedataforteacher/teachers/edit/{id}', [UserController::class, 'edit_teacher'])->name('teachers-edit');
Route::post('/pagedataforteacher/teachers/update/{id}', [UserController::class, 'update_teacher'])->name('teachers-update');


Route::get('/pagedataforemployee/employees/create', [UserController::class, 'create_employee'])->name('employees-add');
Route::post('/pagedataforemployee/employees/store', [UserController::class, 'store_employee']);
Route::get('/pagedataforemployee/employees/edit/{id}', [UserController::class, 'edit_employee'])->name('employees-edit');
Route::post('/pagedataforteacher/employees/update/{id}', [UserController::class, 'update_employee'])->name('employee-update');



Route::post('/pageselectdata_get/{id}/edit_data/addnew_data', [UserController::class, 'add_data_new_DB'])->name('postget_addnew_data');

Route::get('/pagedataforprocess', [UserController::class, 'showprocess'])->name('pageprocess');
Route::get('/pagedataforproject', [UserController::class, 'showproject'])->name('pageproject');
Route::get('/pagedataforproduct', [UserController::class, 'showproduct'])->name('pageproduct');
Route::get('/pagedataforemployee', [UserController::class, 'showemployee'])->name('pageemployee');
Route::get('/pagedataforteacher', [UserController::class, 'showeteacher'])->name('pageteacher');
Route::post('/selectdata', [UserController::class, 'selectshowdata'])->name('pageselectdata');

Route::get('/pageselectdata', [UserController::class, 'dataPage'])->name('data_page');

});

// Route::get('/selectdata', function () {
//     return view('user.page_select_data') ;
// })->name('pageselectdata');
Route::post('/login-check', [UserController::class, 'login'])->name('login-check');






Route::get('/', [UserController::class, 'show'])->name('pageindex')->middleware('check.email');
// Route::get('/form', [UserController::class, 'showform'])->name('pageform');
// Route::post('/nextform', [UserController::class, 'shownextform']);


// Route::get('/Admin', [AdminController::class, 'showAdmin']);