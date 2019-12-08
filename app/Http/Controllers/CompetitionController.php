<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Competition;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompetitionController extends Controller
{


    /**
     * Registrar nueva Competencia
     *
     * Mostrar un formulario para Registrar una nueva competencia del Juez
     *
     * @return \Illuminate\Contracts\Support\Renderable
     **/
    public function register()
    {
        return view('judge\competitions\register');
    }


    /**
     * Mostrar Opciones
     *
     * Funcion para Mostrar las opciones de la aplicacion
     *
     * @param Illuminate\Http\Request $request Peticion
     * @return View
     **/
    public function options(Request $request)
    {
        $id_competition = null;
        try {
            $id_competition = decrypt($request->competition);
        } catch (DecryptException $ex) {
            $id_competition = 0;
        }

        $competition = Competition::find($id_competition);

        return view('judge.competitions.options', compact('competition'));
    }

    /**
     * Guardar la nueva Competencia
     *
     * Funcion para Guardar la nueva Competencia
     *
     * @param Illuminate\Http\Request $request Peticion
     * @return JSON
     * @throws Throwable
     **/
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $resp["status"] = true;
            try {

                $validation = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:30',
                        'idJudge' => 'required',
                        'state' => 'required',
                        'startTime' => 'required|date_format:"d/m/Y H:i"',
                        'endTime' => 'required|date_format:"d/m/Y H:i"',
                        'dificulty' => 'required',
                        'unlockType' => 'required',
                        'gameMode' => 'required',
                    ]
                );

                if ($validation->fails()) {
                    $validationErrors = [];

                    foreach ($validation->getMessageBag()->getMessages() as $key => $value) {
                        $validationErrors[$key] = $value;
                    }
                    $resp["validationErrors"] = $validationErrors;
                    throw new \Exception("Problemas de Validación");
                }

                $competition = new Competition();

                $competition->idJudge = $request->idJudge;
                $competition->name = $request->name;
                $competition->dificulty = $request->dificulty;
                $competition->unlockType = $request->unlockType;
                $competition->gameMode = $request->gameMode;
                $competition->state = $request->state;
                $competition->rules = $request->rules;
                $competition->startTime = Carbon::createFromFormat('d/m/Y H:i', $request->startTime);
                $competition->endTime = Carbon::createFromFormat('d/m/Y H:i', $request->endTime);

                $competition->saveOrFail();
            } catch (\Throwable $ex) {
                $resp["status"] = false;
                $resp["msgError"] = $ex->getMessage();
            } finally {
                return response()->json($resp);
            }
        } else {
            return response()->json(["status" => false, "msgError" => "Error al procesar la peticion"]);
        }
    }

    /**
     * Editar las Opciones
     *
     * Fncion para Editar las opciones
     *
     * @param Illuminate\Http\Request $request Peticion
     * @return JSON
     * @throws Throwable
     **/
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $resp["status"] = true;
            try {
                if (!$request->has('id')) {
                    throw new \Exception("No se encontro las opciones");
                }

                $id = $request->id;

                $competition = Competition::find($id);
                if (is_null($competition)) {
                    throw new \Exception("No se encontro las opciones");
                }

                $validation = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:30',
                        'state' => 'required',
                        'startTime' => 'required|date_format:"d/m/Y H:i"',
                        'endTime' => 'required|date_format:"d/m/Y H:i"',
                        'dificulty' => 'required',
                        'unlockType' => 'required',
                        'gameMode' => 'required',
                    ]
                );

                if ($validation->fails()) {
                    $validationErrors = [];

                    foreach ($validation->getMessageBag()->getMessages() as $key => $value) {
                        $validationErrors[$key] = $value;
                    }
                    $resp["validationErrors"] = $validationErrors;
                    throw new \Exception("Problemas de Validación");
                }

                $competition->name = $request->name;
                $competition->dificulty = $request->dificulty;
                $competition->unlockType = $request->unlockType;
                $competition->gameMode = $request->gameMode;
                $competition->state = $request->state;
                $competition->rules = $request->rules;
                $competition->startTime = Carbon::createFromFormat('d/m/Y H:i', $request->startTime);
                $competition->endTime = Carbon::createFromFormat('d/m/Y H:i', $request->endTime);

                $competition->saveOrFail();
            } catch (\Throwable $ex) {
                $resp["status"] = false;
                $resp["msgError"] = $ex->getMessage();
            } finally {
                return response()->json($resp);
            }
        } else {
            return response()->json(["status" => false, "msgError" => "Error al procesar la peticion"]);
        }
    }
}
