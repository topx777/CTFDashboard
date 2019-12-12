<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Judge;
use App\Team;
use App\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/judges/list';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { }


    public function register(Request $request)
    {
        $response["status"] = true;
        try {
            DB::beginTransaction();
            if (!$request->ajax()) {
                throw new \Exception("Error de peticion");
            }

            $userData = $request->userData;

            if ($userData["role"] == 1) { // Redireccionamiento en caso que se registre exitosamente un juez
                $this->redirectTo = "/admin/judges/list";
            } else if ($userData["role"] == 2) { // En el caso de que sea un equipo
                if (!$request->has('external')) {
                    $this->redirectTo = "/judge/teams/list?competition=" . $request->teamData["idCompetition"];
                } else {
                    $this->redirectTo = "/team/dashboard";
                }
            }

            //En el caso de Juez si requerira el email en User y la confirmacion
            if ($userData["role"] == 1) {
                $validationUser = Validator::make(
                    $userData,
                    [
                        'username' => ['required', 'string', 'max:255', 'unique:users'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                    ]
                );
            } else { // En el caso de que sea equipo es una dinamica diferente de registro de credenciales
                if (!$request->has('external')) {
                    $validationUser = Validator::make(
                        $userData,
                        [
                            'username' => ['required', 'string', 'max:255', 'unique:users'],
                            'password' => ['required', 'string', 'min:8'],
                        ]
                    );
                } else {
                    $validationUser = Validator::make(
                        $userData,
                        [
                            'username' => ['required', 'string', 'max:255', 'unique:users'],
                            'password' => ['required', 'string', 'min:8', 'confirmed'],
                        ]
                    );
                }
            }

            //Estos son arreglos de Errores por tipo de tabla
            $validationErrors = [];
            $validationErrorsUser = [];
            $validationErrorsTeam = [];
            $validationErrorsMember = [];
            $validationErrorMembers = [];

            //Solo faltaria inicializar en el caso de Jueces
            $validationErrorsJudge = [];

            //Si en los campos de la tabla user hay algun error de validacion los registra por nombre de campo
            if ($validationUser->fails()) {
                foreach ($validationUser->getMessageBag()->getMessages() as $key => $error) {
                    $validationErrorsUser[$key] = $error;
                }
            }

            if ($userData['role'] == 1) { //Esto sera si lo que se esta intentando registrar es un juez, es mas sencillo que Equipo xD
                //En este arreglo vendran todos los campos que se registraran en la tabla de judges
                $judgeData = $request->judgeData;

                //Aplicamos validacion de Judge en Base a la tabla
                $validationJudge = Validator::make(
                    $judgeData,
                    [
                        //La unica validacion que necesitamos es esos dos campos
                        'name' => ['required', 'string', 'max:40'],
                        'lastname' => ['required', 'string', 'max:55'],
                    ]
                );

                if ($validationJudge->fails()) {
                    foreach ($validationJudge->getMessageBag()->getMessages() as $key => $error) {
                        //Esto lo que hace es devolvernos error de validacion de cada campo ejemplo
                        $validationErrorsJudge[$key] = $error;
                    }
                }
            }


            //Esto valida si se esta intentando registrar un Equipo
            if ($userData['role'] == 2) { //Esto define si es Team
                $teamData = $request->teamData;
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
                        'idCompetition' => ['required'],
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

            if (count($validationErrorsJudge) > 0) {
                $response["errorsJudge"] = $validationErrorsJudge;
                throw new \Exception("Existen errores de validacion de Juez");
            }


            $user = new User;
            $user->username = $userData["username"];
            if ($userData["role"] == 1) {
                $user->email = $userData["email"];
                $user->email_verified_at = Carbon::now()->timestamp;
            }
            $user->password = Hash::make($userData["password"]);
            $user->role = $userData["role"];

            $response["intended"] = $this->redirectPath();

            $user->saveOrFail();

            if ($user->role == 1) {

                $judge = new Judge;
                $judge->name = $judgeData["name"];
                $judge->lastname = $judgeData["lastname"];
                $judge->idUser = $user->id;

                $judge->saveOrFail();
            }

            if ($user->role == 2) {

                $idCompetition = decrypt($teamData["idCompetition"]);

                $team = new Team;
                $team->idUser = $user->id;
                $team->name = $teamData["name"];
                $team->avatar='default.jpeg';
                $team->phrase = $teamData["phrase"];
                $team->couch = $teamData["couch"];
                $team->teamPassword = $userData["password"];
                $team->idCompetition = $idCompetition;

                $team->saveOrFail();

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
            }

            DB::commit();

            if ($request->has('external')) {
                Auth::loginUsingId($user->id);
            }
        } catch (\Throwable $ex) {
            DB::rollBack();
            $response["status"] = false;
            $response["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($response);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
