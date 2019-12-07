<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Team;
use App\Challenge;

class TeamChallenge extends Model
{
    //
    protected $table = 'teams_challenges';

    public function Team()
    {
        return $this->belongsTo(Team::class, 'idTeam', 'id');
    }

    public function CompetitionChallenge()
    {
        return $this->belongsTo(CompetitionChallenge::class, 'idCompetitionChallenge', 'id');
    }
}
