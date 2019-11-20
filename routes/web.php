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

// login
Route::get('/login', function()
{
    return view('login');
});

// Routes Admin
Route::group(['prefix' => 'admin'], function() {
    Route::get('layout',function()
    {
        return view('adminLayout.master');
    });
});

// Routes Team
Route::group(['prefix' => 'team'], function() {
    Route::get('layout',function()
    {
        return view('teamLayout.master');
    });
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
