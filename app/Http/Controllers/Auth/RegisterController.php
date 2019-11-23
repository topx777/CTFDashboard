<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Team;
use App\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
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
    protected $redirectTo = '/admin/users/list';

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
            $validationUser = Validator::make(
                $userData,
                [
                    'username' => ['required', 'string', 'max:255', 'unique:users'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]
            );

            $validationErrors = [];

            if ($validationUser->fails()) {
                foreach ($validationUser->getMessageBag()->getMessages() as $key => $error) {
                    $validationErrors[$key] = $error;
                }
            }

            if (!$userData['admin'] == "true") {
                $teamData = $request->teamData;
                $membersData = [];
                foreach ($request->membersData as $key => $memberData) {
                    $membersData[] = $memberData;
                }

                $validationTeam = Validator::make(
                    $teamData,
                    [
                        //Cambiar validacion
                        'username' => ['required', 'string', 'max:255', 'unique:users'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                    ]
                );


                $validationsMember = [];
                foreach ($membersData as $key => $memberData) {
                    $validationsMember[] = Validator::make(
                        $memberData,
                        [
                            //Cambiar validacion
                            'username' => ['required', 'string', 'max:255', 'unique:users'],
                            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                            'password' => ['required', 'string', 'min:8', 'confirmed'],
                        ]
                    );
                }

                if ($validationTeam->fails()) {
                    foreach ($validationTeam->getMessageBag()->getMessages() as $key => $error) {
                        $validationErrors[$key] = $error;
                    }
                }

                foreach ($validationsMember as $validationMember) {
                    if ($validationMember->fails()) {
                        $validationErrors[] = "Error de validacion de Miembros";
                    }
                }
            }

            if (count($validationErrors) > 0) {
                $response["errors"] = $validationErrors;
                throw new \Exception("Existen errores de validacion");
            }

            $user = new User;
            $user->username = $userData["username"];
            $user->email = $userData["email"];
            $user->email_verified_at = Carbon::now()->timestamp;
            $user->password = Hash::make($userData["password"]);
            $user->admin = $userData["admin"] == "true" ? true : false;

            $response["intended"] = $this->redirectPath();

            $user->saveOrFail();

            if (!$user->admin) {
                $team = new Team;
                $team->idUser = $user->id;
                $team->name = $teamData["name"];
                $team->score = $teamData["score"];
                $team->phrase = $teamData["phrase"];
                $team->avatar = $teamData["avatar"];
                $team->couch = $teamData["couch"];
                $team->teamPassword = $teamData["teamPassword"];

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
        } catch (\Throwable $ex) {
            DB::rollBack();
            $response["status"] = false;
            $response["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($response);
        }
    }

    /**
     *  Function Registro de usuarios
     *
     *  Function creacion y validacion de usuario administrador y usuario de equipo
     *
     * @param Request $request Request
     * @return response()->json($array)
     * @throws \Throwable $ex
     **/
    // public function register(Request $request)
    // {
    //     $response["status"] = true;
    //     try {

    //         DB::beginTransaction();

    //         if (!$request->ajax()) {
    //             throw new Exception("Error de peticion");
    //         }

    //         $userData = $request->userData;
    //         $validationUser = $this->validator($userData);

    //         $validationErrors = [];
    //         if ($validationUser->fails()) {
    //             foreach ($validationUser->errors()->toArray() as $key => $error) {
    //                 $validationErrors[] = $error;
    //             }
    //         }

    //         if (!$userData->has('admin')) {
    //             $teamData = $request->teamData;
    //             $membersData = [];
    //             foreach ($request->membersData as $key => $memberData) {
    //                 $membersData[] = $memberData;
    //             }

    //             $validationTeam = $this->validator($teamData);
    //             $validationsMember = [];
    //             foreach ($membersData as $key => $memberData) {
    //                 $validationsMember[] = $this->validator($memberData);
    //             }

    //             if ($validationTeam->fails()) {
    //                 foreach ($validationTeam->errors()->toArray() as $key => $error) {
    //                     $validationErrors[] = $error;
    //                 }
    //             }

    //             foreach ($validationsMember as $validationMember) {
    //                 if ($validationMember->fails()) {
    //                     $validationErrors[] = "Error de validacion de Miembros";
    //                 }
    //             }
    //         }

    //         if (count($validationErrors) > 0) {
    //             $response["errors"] = $validationErrors;
    //             throw new Exception("Existen errores de validacion");
    //         }

    //         $user = new User;
    //         $user->username = $userData["username"];
    //         $user->email = $userData["email"];
    //         $user->email_verified_at = Carbon::now()->timestamp;
    //         $user->password = Hash::make($userData["passsword"]);
    //         $user->admin = $userData->has('admin') ? true : false;

    //         $user->saveOrFail();

    //         if (!$user->admin) {
    //             $team = new Team;
    //             $team->idUser = $user->id;
    //             $team->name = $teamData["name"];
    //             $team->score = $teamData["score"];
    //             $team->phrase = $teamData["phrase"];
    //             $team->avatar = $teamData["avatar"];
    //             $team->couch = $teamData["couch"];
    //             $team->teamPassword = $teamData["teamPassword"];

    //             $team->saveOrFail();

    //             foreach ($membersData as $key => $memberData) {
    //                 $member = new Member;

    //                 $member->idTeam = $team->id;
    //                 $member->name = $memberData["name"];
    //                 $member->lastname = $memberData["lastname"];
    //                 $member->email = $memberData["email"];
    //                 $member->career = $memberData["career"];
    //                 $member->university = $memberData["university"];
    //                 $member->saveOrFAil();
    //             }

    //             DB::commit();
    //         }
    //     } catch (\Throwable $ex) {
    //         DB::rollBack();
    //         $response["status"] = false;
    //         $response["msgError"] = $ex->getMessage();
    //     } finally {
    //         return response()->json($response);
    //     }
    // }
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
