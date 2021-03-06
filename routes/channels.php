<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('scoreBoard', function () {
    return true;
});

// canal de puntuaciones por Competicion
Broadcast::channel('Copetition.ScoreBoard.{competitionId}', function ($user, $competitionId) {
    // return((int)$user->Team->idCompetition==(int)$competitionId);
    return true;
});

Broadcast::channel('TeamChallenge.Levels.{competitionId}.{teamId}', function ($user, $competitionId, $teamId) {
    $teamSecurity = (int) $user->Team->id == (int) $teamId;
    $competitionSecurity = (int) $user->Team->Competition->id == (int) $competitionId;
    return $teamSecurity && $competitionSecurity;
});
