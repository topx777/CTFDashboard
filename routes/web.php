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

// Routes de Administrador
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

    Route::get('/home', 'HomeController@index')->name('admin.home');

    // Rutas de User
    Route::any('/users/list', 'UserController@list')->name('users.list');
    Route::get('/users/register', 'UserController@register')->name('users.register');
    Route::get('/users/get', 'UserController@get')->name('users.get');
    Route::post('/users/update', 'UserController@update')->name('users.update');
    Route::post('/users/delete', 'UserController@delete')->name('users.delete');

    // Route Judge
    Route::get('/judges/list', 'JudgeController@list')->name('judges.list');
    Route::get('/judges/register', 'JudgeController@register')->name('judges.register');
    Route::get('/judges/detail/{id}', 'JudgeController@detail')->name('judges.detail');
    Route::get('/judges/get', 'JudgeController@get')->name('judges.get');
    Route::post('/judges/update', 'JudgeController@update')->name('judges.update');
    Route::post('/judges/delete', 'JudgeController@delete')->name('judges.delete');


    // Route Competitions
    Route::get('/competitions/list', 'CompetitionsController@list')->name('competitions.list');
    Route::get('/competitions/detail/{id}', 'CompetitionsController@detail')->name('competitions.detail');
    Route::get('/competitions/get', 'CompetitionsController@get')->name('competitions.get');
    Route::post('/competitions/disable', 'CompetitionsController@disable')->name('competitions.disable');
    Route::post('/competitions/disable/list', 'CompetitionsController@disableList')->name('competitions.disable.list');
});




// Routes Juez
Route::group(['prefix' => 'judge', 'middleware' => ['judge']], function () {

    Route::get('/home', 'HomeController@judgeIndex')->name('judge.home');

    //Rutas de Opciones de Competicion
    Route::get('/competitions/options', 'CompetitionController@options')->name('competitions.options');
    Route::get('/competitions/register', 'CompetitionController@register')->name('competitions.register');
    Route::post('/competitions/update', 'CompetitionController@update')->name('competitions.update');
    Route::post('/competitions/store', 'CompetitionController@store')->name('competitions.store');
    Route::post('/competitions/reset', 'CompetitionController@reset')->name('competitions.reset');
    Route::post('/competitions/delete', 'CompetitionController@delete')->name('competitions.delete');

    //Retos Competencia
    Route::get('/competitionChallenge/list', 'CompetitionChallengeController@list')->name('competitionChallenge.list');
    Route::get('/competitionChallenge/register', 'CompetitionChallengeController@register')->name('competitionChallenge.register');
    Route::post('/competitionChallenge/store', 'CompetitionChallengeController@store')->name('competitionChallenge.store');
    Route::post('/competitionChallenge/delete', 'CompetitionChallengeController@delete')->name('competitionChallenge.delete');


    // Rutas de Team
    Route::any('/teams/list', 'TeamController@list')->name('teams.list');
    Route::get('/teams/register', 'TeamController@register')->name('teams.register');
    Route::post('/teams/get', 'TeamController@get')->name('teams.get');
    Route::get('/teams/detail/{id}', 'TeamController@detail')->name('teams.detail');
    Route::post('/teams/update', 'TeamController@update')->name('teams.update');
    Route::post('/teams/delete', 'TeamController@delete')->name('teams.delete');
    Route::get('/teams/printCredentials', 'TeamController@printCredentials')->name('teams.printCredentials');


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
    Route::post('/challenges/store', 'ChallengeController@store')->name('challenges.store');
    Route::get('/challenges/get', 'ChallengeController@get')->name('challenges.get');
    Route::get('/challenges/detail/{id}', 'ChallengeController@detail')->name('challenges.detail');
    Route::get('/challenges/edit/{id}', 'ChallengeController@edit')->name('challenges.edit');
    Route::post('/challenges/update', 'ChallengeController@update')->name('challenges.update');
    Route::post('/challenges/delete', 'ChallengeController@delete')->name('challenges.delete');
    //Administrador de Archivos
    Route::get('/files/list', 'FileController@list')->name('files.list');
    Route::get('/files/getAll', 'FileController@getAll')->name('files.getAll');
    Route::post('/files/upload', 'FileController@upload')->name('files.upload');
    Route::post('/files/delete', 'FileController@delete')->name('files.delete');

    //Estadisticas
    Route::get('/stadisticTeam', 'StadisticController@teamScore')->name('team.stadisticTeam');
    Route::get('/stadisticHint', 'StadisticController@teamDiscount')->name('team.stadisticHint');
});

// Routes Team que no son administradores
Route::group(['prefix' => 'team', 'middleware' => ['team']], function () {
    Route::get('/dashboard', 'TeamController@dashboard')->name('team.dashboard');
    Route::get('/retos', 'TeamController@challenges')->name('team.challenges');
    /* esto es para retornar el json de los datos de challenge */
    Route::get('/retoJson', 'TeamController@getLevelChallenge')->name('team.getLevelChallenges');
    Route::get('/scoreboard', function () {
        return view('team.scoreBoard');
    })->name('team.tablescore');
    Route::get('/teamChallenges', 'TeamChallengeController@list')->name('team.teamChallenges');
    /* esto es para ver la vista de retos */
    Route::get('/challenge/{id}', 'ChallengeController@showTeamChallenge')->name('team.showChallenge');
    /* ruta para editar si utiliza la ayuda */
    Route::post('/help', 'TeamChallengeController@UpdateHint')->name('teamschallenge.update');
    //ruta para enviar el flag
    Route::post('/flag', 'ChallengeController@enterFlag')->name('challenge.flag');

    Route::get('/getHint', 'TeamChallengeController@getHint')->name('team.getHint');
});

//Routes Public
Route::get('/teamsScore', 'TeamController@dataScoreBoard')->name('team.teamsScore'); //Datos score json table positions
Route::get('/competitions/positions/{id}', 'CompetitionsController@TeamsPositions');
Route::get('/scoreboard/{id}','CompetitionsController@TeamsPositionsPublic');
Route::get('/timer', function () {
    return view('public.timer');
});

Route::get('/guest/register', 'HomeController@registerTeam')->name('guest.register')->middleware('guest');
