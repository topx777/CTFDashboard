<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use App\Challenge;
use App\Category;
use App\TeamChallenge;
use App\Team;
use Illuminate\Support\Facades\DB;

class TeamChallengeController extends Controller
{
    public function list(Request $request)
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
