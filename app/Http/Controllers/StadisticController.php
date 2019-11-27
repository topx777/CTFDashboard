<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StadisticController extends Controller
{
    public function teamScore(Request $request)
    {
        $team=Team::select('id','name','score')->orderBy('score','desc')->get();
        echo $team;
        return response()->json(['team'=>$team]);
    }

    public function teamFlag(Request $request)
    {
        $teamflag=Team::select('id','name','flag');
    }

    public function teamDiscount(Request $request)
    {
        $team=DB::table('teams')
                    ->join('teams_challenges','teams.id','=','teams_challenges.idTeam')
                    ->where('teams_challenges.whithHint','=',true)->count()
                    ->orderBy('teams_challenges_count','desc');
                    echo $team;
                    return response()->json(['disc'=>$team]);
    }
}
