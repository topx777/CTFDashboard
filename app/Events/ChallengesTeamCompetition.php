<?php

namespace App\Events;

use App\Team;
use App\Level;
use App\Category;
use App\Competition;
use App\CompetitionChallenge;
use Illuminate\Support\Facades\DB;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChallengesTeamCompetition implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /** @var Competition $competition  Competicion de la que se extraeran datos*/
    private $idCompetition;

    /** @var Team $team Equipo de la que se extraeran datos*/
    private $idTeam;

    /** @var Array $levels Retos Arreglo de Equipos con posicion puntuacion y orden*/
    public $levels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($idCompetition, $idTeam)
    {
        $this->idCompetition = $idCompetition;
        $this->idTeam = $idTeam;
        $this->levels = $this->getLevels($idCompetition, $idTeam);
    }

    private function getLevels($idCompetition, $idTeam)
    {
        $competition = Competition::find($idCompetition);
        $team = Team::find($idTeam);

        if (is_null($competition)) return ['level' => []];
        if (is_null($team)) return ['level' => []];

        $levels = Level::select('id', 'name', 'order')
            ->where('idCompetition', $competition->id)
            ->orderBy('order', 'asc')->get();

        foreach ($levels as $key => $level) {
            $level->challenges = DB::table('competition_challenges')
                ->select('competition_challenges.id', 'challenges.name', 'challenges.idCategory', 'teams_challenges.finish')
                ->leftJoin('challenges', 'competition_challenges.idChallenge', '=', 'challenges.id')
                ->leftjoin('teams_challenges', function ($q) use ($team) {
                    $q->on('competition_challenges.id', '=', 'teams_challenges.idCompetitionChallenge')
                        ->where('teams_challenges.idTeam', '=', $team->id);
                })
                ->where('competition_challenges.idLevel', $level->id)
                ->get();

            $level->challengesTotal = CompetitionChallenge::where('idLevel', $level->id)->count();
            $level->challengesSuccess = DB::table('teams_challenges')
                ->join('competition_challenges', 'teams_challenges.idCompetitionChallenge', '=', 'competition_challenges.id')
                ->join('challenges', 'competition_challenges.idChallenge', '=', 'challenges.id')
                ->join('levels', 'levels.id', '=', 'competition_challenges.idLevel')
                ->where('teams_challenges.finish', true)
                ->where('teams_challenges.idTeam', $team->id)
                ->where('levels.id', $level->id)->count();

            //retos totales de nivel

            if ($competition->dificulty == 0) {
                $percentDificulty = 0.25;
            } else if ($competition->dificulty == 1) {
                $percentDificulty = 0.5;
            } else if ($competition->dificulty == 2) {
                $percentDificulty = 0.75;
            } else if ($competition->dificulty == 3) {
                $percentDificulty = 1;
            } else {
                $percentDificulty = 0.6;
            }

            $totalChallenges = $level->challengesTotal;

            if ($competition->unlockType == 0) {
                if ($key > 0) {
                    $totalAllChallenges = 0;
                    $totalSuccess = 0;
                    for ($i = 0; $i < $key; $i++) {
                        $totalAllChallenges += $levels[$i]->challengesTotal;
                        $totalSuccess += $levels[$i]->challengesSuccess;
                    }

                    if ($levels[$key - 1]->challengesSuccess > 0) {
                        $level->CompletedRequired = ceil($totalAllChallenges * $percentDificulty);
                        $level->lock = $totalSuccess < $totalAllChallenges;
                    } else {
                        $level->CompletedRequired = ceil($totalChallenges * $percentDificulty);
                        $level->lock = true;
                    }
                } else {
                    $level->CompletedRequired = ceil($totalChallenges * $percentDificulty);
                    $level->lock = false;
                }
            } else if ($competition->unlockType == 1) {
                $level->CompletedRequired = ceil($totalChallenges * $percentDificulty);
                $level->lock = $key > 0 ? (($levels[$key - 1]->CompletedRequired > 0) ? $levels[$key - 1]->challengesSuccess < $levels[$key - 1]->CompletedRequired : true) : false;
            } else {
                $level->CompletedRequired = ceil($totalChallenges * $percentDificulty);
                $level->lock = $key > 0 ? (($levels[$key - 1]->CompletedRequired > 0) ? $levels[$key - 1]->challengesSuccess < $levels[$key - 1]->CompletedRequired : true) : false;
            }

            foreach ($level->challenges as $key => $challenge) {
                $challenge->id = encrypt($challenge->id);
                $challenge->category = Category::select('id', 'name')->where('id', $challenge->idCategory)->get();
            }
        }

        return ['level' => $levels];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('TeamChallenge.Levels.' . $this->idCompetition . '.' . $this->idTeam);
    }
}
