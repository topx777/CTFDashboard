<?php

namespace App;

use App\Level;
use App\Challenge;
use App\Competition;
use App\TeamChallenge;
use Illuminate\Database\Eloquent\Model;

class CompetitionChallenge extends Model
{
    protected $table = 'competition_challenges';

    public function Level()
    {
        return $this->belongsTo(Level::class, 'idLevel', 'id');
    }

    public function Competition()
    {
        return $this->belongsTo(Competition::class, 'idCompetition', 'id');
    }

    public function Challenge()
    {
        return $this->belongsTo(Challenge::class, 'idChallenge', 'id');
    }

    public function TeamChallenges()
    {
        return $this->hasMany(TeamChallenge::class, 'idCompetitionChallenge', 'id');
    }
}
