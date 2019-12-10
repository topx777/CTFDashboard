<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use App\Member;
use DataTables;
use PDF;
use App\Challenge;
use App\Competition;
use App\TeamChallenge;
use Illuminate\Http\Request;
use App\Events\TeamsPositions;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Throwable;

class TeamController extends Controller
{
    /**
     * Funcion list
     *
     * Funcion para listar los Equipos
     *
     * @return view
     **/
    public function list(Request $request)
    {
        if ($request->ajax()) {

            if ($request->has('competition')) {
                $id_competition = null;
                try {
                    $id_competition = decrypt($request->competition);
                } catch (DecryptException $ex) {
                    $id_competition = 0;
                }

                if ($request->has('search') && !is_null($request->search["value"])) {
                    $search = $request->search["value"];

                    $data = Team::where('name', 'LIKE', "%$search%")
                        ->where('idCompetition', $id_competition)->get();
                } else {
                    $data = Team::where('idCompetition', $id_competition)->get();
                }
            } else {
                $data = Team::where('id', 0)->get();
            }


            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $row = encrypt($row->id);
                    return $row;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('judge.teams.list');
    }


    /**
     * Funcion list
     *
     * Funcion para listar los equipos (Administrador)
     *
     * @return view
     **/
    public function get(Request $request)
    {

        $response["status"] = true;
        try {

            if (!$request->ajax()) {
                throw new \Exception("Error de peticion");
            }
            $id = $request->id;
            $team = Team::find($id);

            if (is_null($team)) {
                throw new \Exception("Error, no se pudo encontrar el team");
            }

            $response["teamData"] = $team;
            $idUser = $team->idUser;
            $user = User::find($idUser);
            $response["userData"] = $user;

            $members = [];
            $members = Member::where('idTeam', $id)->get();
            $response["membersData"] = $members;
        } catch (\Throwable $ex) {
            $response["status"] = false;
            $response["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($response);
        }
    }

    /**
     * Funcion detail
     *
     * Funcion para detalles los equipos (Administrador)
     *
     * @return view
     **/
    public function detail(Request $request, $id)
    {
        $id_team = null;
        try {
            $id_team = decrypt($id);
        } catch (DecryptException $ex) {
            $id_team = 0;
        }

        $team = Team::find($id_team);

        return view('judge.teams.detail', compact('team', 'id'));
    }


    /**
     * funcion register
     *
     * Funcion para mostrar la vista de registro de los equipos (Administrador)
     *
     * @param \Illuminate\Http\Request $request Solicitud
     * @return \Illuminate\Contracts\Support\Renderable
     **/
    public function register(Request $request)
    {
        $competition_id = null;
        if ($request->has('competition')) {
            try {
                $competition_id = decrypt($request->competition);
            } catch (DecryptException $ex) {
                $competition_id = 0;
            }
        }

        $competition = Competition::find($competition_id);

        return view('judge.teams.register', compact('competition'));
    }
    /**
     * Funcion para Modificar equipo
     *
     * Modificar el equipo
     *
     * @param Request $request Peticion
     * @return JSON
     * @throws \Throwable
     **/
    public function update(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax()) {
            $response["status"] = true;
            try {
                DB::beginTransaction();

                //Esto valida si se esta intentando registrar un Equipo
                $teamData = $request->teamData;

                $id = decrypt($teamData["id"]);

                $team = Team::find($id);

                if (is_null($team)) throw new \Exception("No se encontro el Equipo");

                $userData = $request->userData;

                // En el caso de que sea equipo es una dinamica diferente de registro de credenciales
                $validationUser = Validator::make(
                    $userData,
                    [
                        'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($team->User->id),],
                        'password' => ['required', 'string', 'min:8'],
                    ]
                );


                //Estos son arreglos de Errores por tipo de tabla
                $validationErrors = [];
                $validationErrorsUser = [];
                $validationErrorsTeam = [];
                $validationErrorsMember = [];
                $validationErrorMembers = [];

                //Si en los campos de la tabla user hay algun error de validacion los registra por nombre de campo
                if ($validationUser->fails()) {
                    foreach ($validationUser->getMessageBag()->getMessages() as $key => $error) {
                        $validationErrorsUser[$key] = $error;
                    }
                }


                $membersData = [];
                foreach ($request->membersData as $key => $memberData) {
                    $membersData[] = $memberData;
                }

                $validationTeam = Validator::make(
                    $teamData,
                    [
                        //Cambiar validacion
                        'name' => ['required', 'string', 'max:255'],
                        'couch' => ['required', 'string', 'max:255'],
                        'phrase' => ['required', 'string', 'max:255'],
                        'id' => ['required'],
                    ]
                );


                $validationsMember = [];
                foreach ($membersData as $key => $memberData) {
                    $validationsMember[] = Validator::make(
                        $memberData,
                        [
                            //Cambiar validacion
                            'name' => ['required', 'string', 'max:255',],
                            'lastname' => ['required', 'string', 'max:255'],
                            'email' => ['required', 'string', 'email', 'max:255'],
                            'career' => ['required', 'string', 'max:255'],
                            'university' => ['required', 'string', 'max:255'],
                        ]
                    );
                }

                if ($validationTeam->fails()) {
                    foreach ($validationTeam->getMessageBag()->getMessages() as $key => $error) {
                        $validationErrorsTeam[$key] = $error;
                    }
                }
                $nodosError = [];
                $cont = 0;
                $numNodo = 0;
                foreach ($validationsMember as $validationMember) {
                    if ($validationMember->fails()) {
                        $nodosError[$cont] = $numNodo;
                        $cont += 1;
                        foreach ($validationMember->getMessageBag()->getMessages() as $key => $error) {


                            $validationErrorsMember[$key] = $error;
                        }

                        $validationErrorMembers[] = $validationErrorsMember;
                    }
                    $numNodo += 1;
                }

                if (count($validationErrorsUser) > 0) {
                    $response["errorsUser"] = $validationErrorsUser;
                    throw new \Exception("Existen errores de credenciales");
                }
                if (count($validationErrors) > 0) {
                    $response["errors"] = $validationErrors;
                    throw new \Exception("Existen errores de validacion");
                }

                if (count($validationErrorsTeam) > 0) {
                    $response["errorsTeam"] = $validationErrorsTeam;
                    throw new \Exception("Existen errores de validacion de Equipo");
                }
                if (count($validationErrorMembers) > 0) {
                    $response["errorsMembers"] = $validationErrorMembers;
                    $response["nodosError"] = $nodosError;
                    throw new \Exception("Existen errores de validacion de Miembros");
                }


                $team->name = $teamData["name"];
                $team->phrase = $teamData["phrase"];
                $team->couch = $teamData["couch"];
                $team->teamPassword = $userData["password"];

                $team->saveOrFail();

                foreach ($team->Members as $member) {
                    $member->delete();
                }

                foreach ($membersData as $key => $memberData) {
                    $member = new Member;

                    $member->idTeam = $team->id;
                    $member->name = $memberData["name"];
                    $member->lastname = $memberData["lastname"];
                    $member->email = $memberData["email"];
                    $member->career = $memberData["career"];
                    $member->university = $memberData["university"];
                    $member->saveOrFAil();
                }

                $user = $team->User;
                $user->username = $userData["username"];
                $user->password = Hash::make($userData["password"]);

                $user->saveOrFail();

                DB::commit();
            } catch (\Throwable $ex) {
                DB::rollBack();
                $response["status"] = false;
                $response["msgError"] = $ex->getMessage();
            } finally {
                return response()->json($response);
            }
        } else {
            return response()->json(['status' => false, 'msgError' => 'Error al procesar la peticion']);
        }
    }

    /**
     * Funcion para Eliminar el equipo
     *
     * Eliminar el equipo
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
                DB::beginTransaction();
                $id = decrypt($request->id);
                $team = Team::find($id);
                if (is_null($team)) {
                    throw new \Exception("No se encontro al equipo");
                }
                $members = $team->Members;
                foreach ($members as $member) {
                    $member->delete();
                }
                $user = $team->User;
                $team->delete();
                $user->delete();
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                $resp["status"] = false;
                $resp["msgError"] = $th->getMessage();
            } finally {
                return response()->json($resp);
            }
        } else {
            return response()->json(['status' => false, 'msgError' => 'Error al procesar la peticion']);
        }
    }

    /**
     * dashboard
     *
     *  vista perfil de equipo
     *
     * @return View
     **/
    public function dashboard(Request $request)
    {
        $id = auth()->user()->id;
        $teamData = Team::select('id', 'name', 'score', 'phrase', 'avatar', 'couch')->where('idUser', $id)->first();
        $membersTeam = Member::select('name', 'lastName', 'email', 'career', 'university')
            ->where('idTeam', $teamData->id)
            ->get();
        $options = Competition::select('rules', 'startTime', 'endTime')->first();
        return view('team.dashboard', compact('teamData', 'membersTeam', 'options'));
    }

    /**
     * challenges
     *
     * vista de retos en perfil de equipo

     * @return View
     **/
    public function challenges(Request $request)
    {
        return view('team.challenges');
    }


    public function getLevelChallenge(Request $request)
    {
        $id = $request->id_challenge;
        $challenge = Challenge::find($id);

        $team = Team::where('idUser', auth()->user()->id)->first();

        $challengesLevel[] = $challenge;
        $challengesLevel[0]->Level = $challenge->Level;

        $team_challenge = TeamChallenge::where('idTeam', $team->id)->where('idChallenge', $challenge->id)->first();

        $challengesLevel[0]->TeamChallenge = $team_challenge;
        // $challengesLevel = Challenge::where('idLevel', $challenge->idLevel)->get();

        return response()->json(['challenges' => $challengesLevel]);
    }

    /**
     * data scoreboard
     *
     * Datos json para tabla
     *
     * @return JSON
     **/
    public function dataScoreBoard()
    {
        $teams = Team::orderBy('score', 'desc')->get();
        $teamObj = [];
        foreach ($teams as $key => $team) {
            $teamObj[$key] = $team;
            $teamObj[$key]->flag = TeamChallenge::where('finish', true)->where('idTeam', $team->id)->count();
        }
        return response()->json(['teamsScoreBoard' => $teamObj]);
    }


    /**
     * Funcion Imprimir credenciales
     *
     * En esta funcion se genera un PDF con todas las credenciales de los equipos de la competicion
     *
     * @param \Illuminate\Http\Request $request Peticion
     * @return PDF
     * @throws \Throwable
     **/
    public function printCredentials(Request $request)
    {
        try {
            if (!$request->has('competition')) throw new \Exception("Error, no se encontro la competicion");

            $id_competition = decrypt($request->competition);

            $competition = Competition::find($id_competition);
            if (is_null($competition)) throw new \Exception("Error, no se encontro la competicion");

            $teams = $competition->Teams;

            $pdf = PDF::loadView('judge.teams.teamspdf', compact('teams'));

            return $pdf->stream();
        } catch (\Throwable $th) {
            abort(500, $th->getMessage());
        }
    }
}
