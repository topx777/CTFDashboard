<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use App\CompetitionChallenge;
use App\Events\ECompetitionScoreUpdate;
use App\Team;
use App\TeamChallenge;
use DataTables;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChallengeController extends Controller
{
    /**
     * Funcion list
     *
     * Funcion para listar los Retos
     *
     * @return view
     **/
    public function list(Request $request)
    {
        if ($request->ajax()) {

            if ($request->has('search') && !is_null($request->search["value"])) {
                $search = $request->search["value"];

                $data = Challenge::where('name', 'LIKE', "%$search%")->get();
            } else {
                $data = Challenge::all();
            }

            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $row = $row->id;

                    return $row;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                        <span class="input-group-btn input-group-sm">
                            <a href="' . route('challenges.detail', ["id" => $row->id]) . '" class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i>
                            </a>
                            <button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-danger deleteChallenge">
                                <i class="fa fa-trash"></i>
                            </button>
                            <a href="' . route('challenges.edit', ["id" => $row->id]) . '" class="btn btn-sm btn-warning">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </span>
                    ';

                    return $btn;
                })
                ->editColumn('description', function ($row) {
                    $desc = '<p>' . $row->description . '</p>';
                    return $desc;
                })
                ->editColumn('idCategory', function ($row) {
                    return $row->Category->name;
                })
                ->rawColumns(['action', 'description'])
                ->make(true);
        }

        return view('judge\challenges\list');
    }


    /**
     * Funcion Get
     *
     * Funcion para obtener datos de Reto (Administrador)
     *
     * @return view
     **/
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $challenge = Challenge::find($id);

            if (is_null($challenge)) {
                return response()->json(null);
            }

            return response()->json($challenge);
        } else {
            return response()->json(null);
        }
    }

    /**
     * Funcion detail
     *
     * Funcion para vista detalles los challenge (Administrador)
     *
     * @return view
     **/
    public function detail($id)
    {
        $challenge = Challenge::find($id);

        if (is_null($challenge)) {
            abort('500', 'No se encontro el reto');
        }

        return view('judge\challenges\detail', compact('challenge'));
    }


    /**
     * funcion register
     *
     * Funcion para mostrar la vista de registro de los retos (Administrador)
     *
     * @return view
     **/
    public function register()
    {
        return view('judge\challenges\register');
    }



    /**
     * Guardar un Reto
     *
     * Funcion para
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function store(Request $request)
    {
        $resp["status"] = true;
        try {

            $validation = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:40',
                    'flag' => 'required',
                    'idCategory' => 'required',
                    'dificulty' => 'required',
                ]
            );

            if ($validation->fails()) {
                $validationErrors = [];

                foreach ($validation->getMessageBag()->getMessages() as $key => $error) {
                    $validationErrors[$key][] = $error;
                }

                $resp["validationErrors"] = $validationErrors;
                throw new \Exception("Errores de Validacion");
            }

            $challenge = new Challenge();

            $challenge->idCategory = $request->idCategory;
            $challenge->name = $request->name;
            $challenge->dificulty = $request->dificulty;
            $challenge->description = $request->description;
            $challenge->hint = $request->hint;
            $challenge->flag = $request->flag;

            $challenge->saveOrFail();
        } catch (\Throwable $ex) {
            $resp["status"] = false;
            $resp["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($resp);
        }
    }


    /**
     * Editar el Reto
     *
     * Funcion para mostrar la vista de actualizacion de los retos (Administrador)
     *
     * @return view
     **/
    public function edit($id)
    {
        $challenge = Challenge::find($id);

        if (is_null($challenge)) {
            abort('500', 'No se encontro el reto');
        }

        return view('judge\challenges\edit', compact('challenge'));
    }


    /**
     * Funcion para Modificar retos
     *
     * Modificar el reto
     *
     * @param Request $request Peticion
     * @return JSON
     * @throws \Throwable
     **/
    public function update(Request $request)
    {
        $resp["status"] = true;
        try {
            if (!$request->has('id')) {
                throw new \Exception("No se encontro el reto");
            }


            $validation = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:40',
                    'flag' => 'required',
                    'idCategory' => 'required',
                    'dificulty' => 'required',
                ]
            );

            if ($validation->fails()) {
                $validationErrors = [];

                foreach ($validation->getMessageBag()->getMessages() as $key => $error) {
                    $validationErrors[$key][] = $error;
                }

                $resp["validationErrors"] = $validationErrors;
                throw new \Exception("Errores de Validacion");
            }

            $challenge = Challenge::find($request->id);

            if (is_null($challenge)) {
                throw new \Exception("No se encontro el reto");
            }

            $challenge->idCategory = $request->idCategory;
            $challenge->name = $request->name;
            $challenge->dificulty = $request->dificulty;
            $challenge->description = $request->description;
            $challenge->hint = $request->hint;
            $challenge->flag = $request->flag;

            $challenge->saveOrFail();
        } catch (\Throwable $ex) {
            $resp["status"] = false;
            $resp["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($resp);
        }
    }

    /**
     * Funcion para Eliminar el reto
     *
     * Eliminar el reto
     *
     * @param Request $request Peticion
     * @return JSON
     * @throws \Throwable
     **/
    public function delete(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax()) {
            $resp["status"] = true;
            try {
                if (!$request->has('id')) {
                    throw new \Exception("No se encontro el Reto");
                }

                $id = $request->id;
                $challenge = Challenge::find($id);

                if (is_null($challenge)) {
                    throw new \Exception("No se encontro al Reto");
                }

                $challenge->delete();
            } catch (\Throwable $th) {
                $resp["status"] = false;
                $resp["msgError"] = $th->getMessage();
            } finally {
                return response()->json($resp);
            }
        } else {
            return response()->json(['status' => false, 'msgError' => 'Error al procesar la peticion']);
        }
    }

    public function enterFlag(Request $request)
    {
        $resp["status"] = true;
        try {
            DB::beginTransaction();

            $id_challenge = $request->has('id_challenge') ? $request->id_challenge : null;
            $team = auth()->user()->Team;

            $id_team = !is_null($team) ? $team->id : null;

            if (is_null($id_challenge) || is_null($id_team)) throw new \Exception("No se encontro el equipo, intentar nuevamente");

            $team_challenge = TeamChallenge::where('idCompetitionChallenge', $id_challenge)->where('idTeam', $id_team)->first();

            if (is_null($team_challenge)) {
                $team_challenge = new TeamChallenge();
                $team_challenge->idTeam = $id_team;
                $team_challenge->idCompetitionChallenge = $id_challenge;
            }

            $flag = $request->flag;
            $challenge = CompetitionChallenge::find($id_challenge);

            if (is_null($challenge)) {
                throw new \Exception("No se encontro el reto");
            }

            if (trim($flag) != trim($challenge->Challenge->flag)) {
                throw new \Exception("La flag no corresponde");
            }

            $team_challenge->time = Carbon::now();
            $team_challenge->finish = true;

            $countDiscountPoints = TeamChallenge::where('finish', true)->Where('idCompetitionChallenge', $challenge->id)->count();
            $team_challenge->score = ($challenge->Level->score - $countDiscountPoints) > 0 ? $challenge->Level->score - $countDiscountPoints : 0;

            $team_challenge->saveOrFail();

            $team = Team::findOrFail($team_challenge->idTeam);
            $team->score = $team->score + $team_challenge->score;

            $team->saveOrFail();

            broadcast(new ECompetitionScoreUpdate(auth()->user()->Team->Competition->id));

            DB::commit();
            //recuperar de la base de datos la bandera */
        } catch (\Throwable $ex) {
            DB::rollback();
            $resp["status"] = false;
            $resp["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($resp);
        }
    }

    public function showTeamChallenge($id)
    {
        $id_competition = null;
        try {
            $id_competition = decrypt($id);
        } catch (DecryptException $ex) {
            $id_competition = 0;
        }

        $challenge = CompetitionChallenge::find($id_competition);
        return view('team.challenge', compact('challenge'));
    }
}
