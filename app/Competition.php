<?php

namespace App;

use App\Team;
use App\Judge;
use App\Level;
use App\CompetitionChallenge;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    //
    protected $table = 'competitions';

    public function Judge()
    {
        return $this->belongsTo(Judge::class, 'idJudge', 'id');
    }

    public function Teams()
    {
        return $this->hasMany(Team::class, 'idCompetition', 'id');
    }

    public function Levels()
    {
        return $this->hasMany(Level::class, 'idCompetition', 'id');
    }

    public function Challenges()
    {
        return $this->hasMany(CompetitionChallenge::class, 'idCompetition', 'id');
    }

    static function getByJudge($idUser)
    {
        $user = User::find($idUser);
        return $user->Judge->Competitions;
    }
}
