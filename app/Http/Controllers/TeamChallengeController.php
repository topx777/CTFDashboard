<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use App\Challenge;
use App\Category;
use App\Team;
use App\TeamChallenge;
use Illuminate\Support\Facades\DB;

class TeamChallengeController extends Controller
{
    public function list(Request $request)
    {

        $levels = Level::select('id', 'name', 'order')->orderBy('order', 'asc')->get();
        $lockeds = [];
        foreach ($levels as $key => $level) {
            $level->challenges = Challenge::select('id', 'name', 'idCategory')->where('idLevel', $level->id)->get();

            $teamid = Team::where('idUser', auth()->user()->id)->first()->id;
            $level->challengesTotal = Challenge::where('idLevel', $level->id)->count(); //retos totales de nivel
            $level->challengesSuccess = DB::table('teams_challenges')
                ->join('Challenges', 'teams_challenges.idChallenge', '=', 'Challenges.id')
                ->join('Levels', 'Levels.id', '=', 'Challenges.idLevel')
                ->where('teams_challenges.finish', true)
                ->where('teams_challenges.idTeam', $teamid)
                ->where('Levels.id', $level->id)->count();
            $level->percent60 = ceil($level->challengesTotal * 0.6); //60% del nivel
            $lockeds[] = (!$level->challengesSuccess >= $level->percent60);
            foreach ($level->challenges as $key => $challenge) {
                $challenge->category = Category::select('id', 'name')->where('id', $challenge->idCategory)->get();
            }
        }

        foreach ($levels as $key => $level) {
            if ($key == 0) {
                $level->lock = false;
            } else {
                $level->lock = $lockeds[$key - 1];
            }
        }

        // $levels->map(function ($level)
        // {
        //     $level->challenges=Challenge::select('id', 'name','idCategory')->where('idLevel', $level->id)->get();

        //     $teamid=Team::where('idUser',auth()->user()->id)->first()->id;
        //     $challengesTotal=Challenge::where('idLevel', $level->id)->count();//retos totales de nivel
        //     $challengesSuccess=DB::table('teams_challenges')
        //                         ->join('Challenges','teams_challenges.idChallenge','=','Challenges.id' )
        //                         ->join('Levels', 'Levels.id','=','Challenges.idLevel')
        //                         ->where('teams_challenges.finish',true)
        //                         ->where('teams_challenges.idTeam',$teamid)
        //                         ->where('Levels.id', $level->id)->count();
        //     $percent60= ceil($challengesTotal*0.6);//60% del nivel

        //     $level->lock;

        //     $level->challenges->map(function($challenge)
        //     {   
        //         $challenge->category=Category::select('id','name')->where('id', $challenge->idCategory)->get();
        //     });
        // });
        return response()->json(['level' => $levels]);
    }
    public function enableChallenge(Request $request)
    { }


    public function UpdateHint(Request $request)
    {
        $resp["status"] = true;
        try {
            DB::beginTransaction();
            $team = Team::where('idUser', auth()->user()->id)->first();

            if (is_null($team)) {
                throw new \Exception("No se encontro el equipo");
            }

            $score = $team->score;
            if ($score <= 0) {
                throw new \Exception("Usted no cuenta con suficientes puntos para obtener ayuda");
            }   /* te voy a romper las piernas mejor vas tener que cuerrer */

            $team_challenge = TeamChallenge::where('idChallenge', $request->id_challenge)->first();
            $team_challenge->whithHint = true;
            $team_challenge->saveOrFail();

            $totalDiscount = $team_challenge->Challenge->Level->hintDiscount * $team_challenge->Challenge->Level->score;
            $team->score = ($team->score - $totalDiscount) > 0 ? ($team->score - $totalDiscount) : 0;
            $team->saveOrFail();

            DB::commit();
        } catch (\Throwable $ex) {
            DB::rollback();
            $resp["status"] = false;
            $resp["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($resp);
        }
    }
}
