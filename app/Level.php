<?php

namespace App;

use App\Competition;
use App\CompetitionChallenge;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';

    static function getLevels()
    {
        return Level::all();
    }

    public function Competition()
    {
        return $this->belongsTo(Competition::class, 'idCompetition', 'id');
    }

    public function Challenges()
    {
        return $this->hasMany(CompetitionChallenge::class, 'idLevel', 'id');
    }
}
