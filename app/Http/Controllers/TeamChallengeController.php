<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\TeamsPositions;
use App\Level;
use App\Challenge;
use App\Category;
use App\Competition;
use App\CompetitionChallenge;
use App\Events\ECompetitionScoreUpdate;
use App\Team;
use App\TeamChallenge;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class TeamChallengeController extends Controller
{
    public function list()
    {
        $competition = auth()->user()->Team->Competition;

        if (is_null($competition)) return response()->json(['level' => []]);

        $levels = Level::select('id', 'name', 'order')
            ->where('idCompetition', $competition->id)
            ->orderBy('order', 'asc')->get();
        // $lockeds = [];
        foreach ($levels as $key => $level) {
            $level->challenges = DB::table('competition_challenges')
                ->leftJoin('challenges', 'competition_challenges.idChallenge', '=', 'challenges.id')
                ->leftjoin('teams_challenges', 'competition_challenges.id', '=', 'teams_challenges.idCompetitionChallenge')
                ->select('competition_challenges.id', 'challenges.name', 'challenges.idCategory', 'teams_challenges.finish')
                ->where('competition_challenges.idLevel', $level->id)
                ->get();

            $level->challengesTotal = CompetitionChallenge::where('idLevel', $level->id)->count();
            $level->challengesSuccess = DB::table('teams_challenges')
                ->join('competition_challenges', 'teams_challenges.idCompetitionChallenge', '=', 'competition_challenges.id')
                ->join('challenges', 'competition_challenges.idChallenge', '=', 'challenges.id')
                ->join('levels', 'levels.id', '=', 'competition_challenges.idLevel')
                ->where('teams_challenges.finish', true)
                ->where('teams_challenges.idTeam', auth()->user()->Team->id)
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

        return response()->json(['level' => $levels]);
    }

    public function enableChallenge(Request $request)
    { }


    /**
     * Pedir ayuda
     *
     * Funcion para actulizar la pedida de ayuda de un reto
     *
     * @param Request $request Peticion
     * @return JSON
     * @throws Throwable
     **/
    public function UpdateHint(Request $request)
    {
        $resp["status"] = true;
        try {
            DB::beginTransaction();
            $team = auth()->user()->Team;

            if (is_null($team) || !$request->has('id_challenge')) {
                throw new \Exception("No se encontro el equipo, ni el reto");
            }

            $score = $team->score;
            if ($score <= 0) {
                throw new \Exception("Usted no cuenta con suficientes puntos para obtener ayuda");
            }   /* te voy a romper las piernas mejor vas tener que cuerrer */

            $team_challenge = TeamChallenge::where('idCompetitionChallenge', $request->id_challenge)->where('idTeam', $team->id)->first();
            if (is_null($team_challenge)) {
                $team_challenge = new TeamChallenge();
                $team_challenge->idCompetitionChallenge = $request->id_challenge;
                $team_challenge->idTeam = $team->id;
                $team_challenge->score = 0;
                $team_challenge->time = Carbon::now();
            }
            $team_challenge->whithHint = true;
            $team_challenge->saveOrFail();

            $resp["hint"] = $team_challenge->CompetitionChallenge->Challenge->hint;

            $totalDiscount = $team_challenge->CompetitionChallenge->Level->hintDiscount * $team_challenge->CompetitionChallenge->Level->score;
            $team->score = ($team->score - $totalDiscount) > 0 ? ($team->score - $totalDiscount) : 0;
            $team->saveOrFail();

            \event(new ECompetitionScoreUpdate(auth()->user()->Team->Competition->id));

            DB::commit();
        } catch (\Throwable $ex) {
            DB::rollback();
            $resp["status"] = false;
            $resp["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($resp);
        }
    }


    /**
     * Obtener la ayuda
     *
     * Obtener la ayuda del reto
     *
     * @param Request $request Peticion
     * @return JSON
     * @throws Throwable
     **/
    public function getHint(Request $request)
    {
        $resp["status"] = true;
        try {
            if (!$request->has('id_challenge')) {
                throw new \Exception("No se encontro el reto");
            }

            $challenge = CompetitionChallenge::find($request->id_challenge);

            if (is_null($challenge)) throw new \Exception("No se encontro la ayuda");

            $resp["hint"] = $challenge->Challenge->hint;
        } catch (Throwable $ex) {
            $resp["status"] = false;
            $resp["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($resp);
        }
    }
}
