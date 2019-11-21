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

    Route::get('/home', function () {
        return view('admin/home');
    });

    // Rutas de User
    Route::any('/users/list', 'UserController@list')->name('users/list');
    Route::get('/users/register', 'UserController@register')->name('users/register');
    Route::get('/users/get', 'UserController@get')->name('users/get');
    Route::post('/users/update', 'UserController@update')->name('users/update');
    Route::post('/users/delete', 'UserController@delete')->name('users/delete');

    // Rutas de Team
    Route::any('/teams/list', 'TeamController@list')->name('teams/list');
    Route::get('/teams/register', 'TeamController@register')->name('teams/register');
    Route::get('/teams/get', 'TeamController@get')->name('teams/get');
    Route::post('/teams/update', 'TeamController@update')->name('teams/update');
    Route::post('/teams/delete', 'TeamController@delete')->name('teams/delete');
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
