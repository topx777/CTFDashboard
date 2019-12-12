<?php

namespace App\Http\Controllers;

use App\Level;
use DataTables;
use App\Challenge;
use App\Competition;
use Illuminate\Http\Request;
use App\CompetitionChallenge;
use Illuminate\Contracts\Encryption\DecryptException;

class CompetitionChallengeController extends Controller
{
    /**
     * Funcion list
     *
     * Funcion para listar los Retos de la Competencia
     *
     * @return view
     **/
    public function list(Request $request)
    {
        if ($request->ajax()) {

            if ($request->has('idCompetition')) {

                try {
                    $id_competition = decrypt($request->idCompetition);
                } catch (DecryptException $ex) {
                    $id_competition = 0;
                }

                if ($request->has('search') && !is_null($request->search["value"])) {
                    $search = $request->search["value"];
                    $data = CompetitionChallenge::select('competition_challenges.*')
                        ->join('challenges', function ($join) use ($search) {
                            $join->on('challenges.id', '=', 'competition_challenges.idCompetition')
                                ->where('challenges.name', 'LIKE', "%$search%");
                        })
                        ->where('competition_challenges.idCompetition', '=', $id_competition)
                        ->get();
                } else {
                    $data = CompetitionChallenge::all();
                }
            } else {
                $data = CompetitionChallenge::where('id', 0)->get();
            }

            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $row = $row->id;
                    return $row;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                        <span class="input-group-btn input-group-sm">
                            <button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-danger deleteChallenge">
                                <i class="fa fa-trash"></i>
                            </button>
                        </span>
                    ';
                    return $btn;
                })
                ->editColumn('idChallenge', function ($row) {
                    $challenge = $row->Challenge->name;
                    return $challenge;
                })
                ->editColumn('idLevel', function ($row) {
                    return $row->Level->name;
                })
                ->addColumn('flag', function ($row) {
                    $flag = $row->Challenge->flag;
                    return $flag;
                })
                ->addColumn('hint', function ($row) {
                    $hint = $row->Challenge->hint;
                    return $hint;
                })
                ->addColumn('category', function ($row) {
                    $category = $row->Challenge->Category->name;
                    return $category;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('judge.competitionChallenge.list');
    }


    /**
     * Funcion para Registrar Reto a Competencia
     *
     * En esta funcion registra el reto a la competencia
     *
     * @param \Illuminate\Http\Request $request Peticion
     * @return \Illuminate\Contracts\Support\Renderable
     **/
    public function register(Request $request)
    {
        $id_competition = null;
        try {
            $id_competition = decrypt($request->idCompetition);
        } catch (DecryptException $ex) {
            $id_competition = 0;
        }

        $competition = Competition::find($id_competition);

        return view('judge.competitionChallenge.register', compact('id_competition', 'competition'));
    }


    /**
     * Funcion Asignar Reto a Competencia
     *
     * En la funcion se asigna un reto y su nivel a una competencia
     *
     * @param \Illuminate\Http\Request $request Peticion
     * @return JSON
     * @throws \Throwable
     **/
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $resp["status"] = true;
            try {
                if (!$request->has('idCompetition')) {
                    throw new \Exception("No se encontro la competencia");
                }

                if (!$request->has('idChallenge')) {
                    throw new \Exception("No se encontro el reto");
                }

                if (!$request->has('idLevel')) {
                    throw new \Exception("No se encontro el nivel");
                }

                $id_competition = decrypt($request->idCompetition);
                $competition = Competition::findOrFail($id_competition);
                $challenge = Challenge::findOrFail($request->idChallenge);
                $level = Level::findOrFail($request->idLevel);

                $competitionChallenge = new CompetitionChallenge;

                $competitionChallenge->idCompetition = $competition->id;
                $competitionChallenge->idChallenge = $challenge->id;
                $competitionChallenge->idLevel = $level->id;

                $competitionChallenge->saveOrFail();
            } catch (\Throwable $th) {
                $resp["status"] = false;
                $resp["msgError"] = $th->getMessage();
            } finally {
                return response()->json($resp);
            }
        } else {
            return response()->json(["status" => false, "msgError" => "Error al procesar la peticion"]);
        }
    }


    /**
     * Funcion Eliminar Reto a Competencia
     *
     * En la funcion elimina un reto y su nivel a una competencia
     *
     * @param \Illuminate\Http\Request $request Peticion
     * @return JSON
     * @throws \Throwable
     **/
    public function delete(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $resp["status"] = true;
            try {
                if (!$request->has('id')) {
                    throw new \Exception("No se encontro la competencia");
                }

                $id = $request->id;
                $competitionChallenge = CompetitionChallenge::find($id);

                if (is_null($competitionChallenge)) {
                    throw new \Exception("No se encontro el reto");
                }

                $competitionChallenge->delete();
            } catch (\Throwable $th) {
                $resp["status"] = false;
                $resp["msgError"] = $th->getMessage();
            } finally {
                return response()->json($resp);
            }
        } else {
            return response()->json(["status" => false, "msgError" => "Error al procesar la peticion"]);
        }
    }
}
