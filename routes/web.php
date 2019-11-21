<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Error Routes
Route::get('/denied', function () {
    return view('error\permissionError');
})->name('permissionError');

Route::get('/test', function () {
    return view('admin.users.list');
});

// Routes Admin
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    // Route::get('layout', function () {
    //     return view('adminLayout.master');
    // });
    Route::get('/home', function () {
        return view('admin/home');
    });
    Route::get('/users/register', function () {
        return view('admin.users.register');
    });
});

// Routes Team
Route::group(['prefix' => 'team', 'middleware' => ['team']], function () {
    // Route::get('layout', function () {
    //     return view('teamLayout.master');
    // });
    Route::get('/dashboard', function () {
        return view('team/dashboard');
    });
});


Auth::routes();
