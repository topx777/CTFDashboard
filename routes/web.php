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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

//Error Routes
Route::get('/denied', function () {
    return view('error.permissionError');
})->name('permissionError');

// Routes Admin
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

    Route::get('/home', 'HomeController@index')->name('admin.home');

    //Rutas de Opciones
    Route::get('/options', 'OptionController@show')->name('options');
    Route::post('/options/update', 'OptionController@update')->name('options.update');

    // Rutas de User
    Route::any('/users/list', 'UserController@list')->name('users.list');
    Route::get('/users/register', 'UserController@register')->name('users.register');
    Route::get('/users/get', 'UserController@get')->name('users.get');
    Route::post('/users/update', 'UserController@update')->name('users.update');
    Route::post('/users/delete', 'UserController@delete')->name('users.delete');

    // Rutas de Team
    Route::any('/teams/list', 'TeamController@list')->name('teams.list');
    Route::get('/teams/register', 'TeamController@register')->name('teams.register');
    Route::get('/teams/get/{$id}', 'TeamController@get')->name('teams.get');
    Route::get('/teams/detail/{id}', 'TeamController@detail')->name('teams.detail');
    Route::post('/teams/update', 'TeamController@update')->name('teams.update');
    Route::post('/teams/delete', 'TeamController@delete')->name('teams.delete');


    //Ruta {Categoria/ Nivel
    Route::get('/levelsCategories/list', function () {
        return view('admin.levelsCategories.list');
    })->name('levelsCategories.list');

    //Rutas de Level AJAX
    Route::any('/levels/list', 'LevelController@list')->name('levels.list');
    Route::post('/levels/store', 'LevelController@store')->name('levels.store');
    Route::get('/levels/get', 'LevelController@get')->name('levels.get');
    Route::post('/levels/update', 'LevelController@update')->name('levels.update');
    Route::post('/levels/delete', 'LevelController@delete')->name('levels.delete');

    Route::get('/levels/getAll', 'LevelController@getAll')->name('levels.getAll');

    //Rutas de Category AJAX
    Route::any('/categories/list', 'CategoryController@list')->name('categories.list');
    Route::post('/categories/store', 'CategoryController@store')->name('categories.store');
    Route::get('/categories/get', 'CategoryController@get')->name('categories.get');
    Route::post('/categories/update', 'CategoryController@update')->name('categories.update');
    Route::post('/categories/delete', 'CategoryController@delete')->name('categories.delete');
    Route::get('/categories/getAll', 'CategoryController@getAll')->name('categories.getAll');

    // Rutas de Chellange
    Route::any('/challenges/list', 'ChallengeController@list')->name('challenges.list');
    Route::get('/challenges/register', 'ChallengeController@register')->name('challenges.register');
    Route::get('/challenges/get/{$id}', 'ChallengeController@get')->name('challenges.get');
    Route::get('/challenges/detail/{id}', 'ChallengeController@detail')->name('challenges.detail');
    Route::post('/challenges/update', 'ChallengeController@update')->name('challenges.update');
    Route::post('/challenges/delete', 'ChallengeController@delete')->name('challenges.delete');
    Route::get('/challenges/filemanager', 'FilesController@upload')->name('challenges.upload');

    //Administrador de Archivos
    Route::get('/files/list', 'FileController@list')->name('files.list');
    Route::get('/files/getAll', 'FileController@getAll')->name('files.getAll');
    Route::post('/files/upload', 'FileController@upload')->name('files.upload');
    Route::post('/files/delete', 'FileController@delete')->name('files.delete');
});

// Routes Team que no son administradores
Route::group(['prefix' => 'team', 'middleware' => ['team']], function () {
    Route::get('/dashboard', 'TeamController@dashboard')->name('team.dashboard');
    Route::get('/retos', 'TeamController@challenges')->name('team.challenges');
    Route::get('/reto', function () {
        return view('team.challenge');
    })->name('team.showChallenges');
    //controlador funcion que muestra los datos de challenge
    Route::get('/teams/challenges', 'TeamController@showChallenge')->name('team.tshowChallenge');
});
