<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Member;
use App\TeamChallenge;

class Team extends Model
{
    //
    protected $table = 'teams';

    public function Members()
    {
        return $this->hasMany(Member::class, 'idTeam', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }

    public function Challenges()
    {
        return $this->hasMany(TeamChallenge::class, 'idTeam', 'id');
    }

    static function getTeamID($idUser)
    {
        return (Team::where('idUser', $idUser)->first())->id;
    }
}
