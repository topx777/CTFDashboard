<?php

namespace App;

use App\Team;
use App\Judge;
use App\Level;
use App\CompetitionChallenge;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    static function getRouteID($id)
    {
        try {
            $url_param = decrypt($id);
            return $url_param;
        } catch (DecryptException $ex) {
            return 0;
        }
    }

    /**
     * Scoreboard Array
     *
     * Devuelve el scoreboard de competicion ordenado con datos relevantes
     *
     * @param Int $id id de competicion
     * @return Array
     **/
    static function scoreboard($id)
    {
        $competition=Competition::find($id);
        $teamsPositions=$competition->Teams->sortByDesc('score');
        $teamsPositions=$teamsPositions->values()->all();
        $finalTableScore=[];
        foreach ($teamsPositions as $key => $team) {
            $teamItem=new \stdClass;
            $teamItem->id=$team->id;
            $teamItem->position=$key+1;
            $teamItem->name=$team->name;
            $teamItem->flags=DB::table('teams_challenges')
                            ->join('competition_challenges','teams_challenges.idCompetitionChallenge','=','competition_challenges.id')
                            ->join('teams','teams.id','=','teams_challenges.idTeam')
                            ->where('teams.id','=',$team->id)
                            ->where('teams_challenges.finish','=',true)
                            ->where('competition_challenges.idCompetition','=',$id)->count();
            $teamItem->score=$team->score;
            $finalTableScore[]=$teamItem;
        }
        return ['scoreboard'=> $finalTableScore];


    }
}
