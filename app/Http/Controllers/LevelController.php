<?php

namespace App\Http\Controllers;

use App\Level;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;

class LevelController extends Controller
{
    /**
     * Listar Niveles
     *
     * Funciona para listar niveles con busqueda, con DataTables AJAX
     *
     * @param Request $request Peticion
     * @return DataTable
     * @throws \Throwable
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

                    $data = Level::where('name', 'LIKE', "%$search%")
                        ->where('idCompetition', $id_competition)->orderBy('order', 'asc')->get();
                } else {
                    $data = Level::where('idCompetition', $id_competition)->orderBy('order', 'asc')->get();
                }
            } else {
                $data = Level::where('id', 0)->get();
            }

            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $btn = encrypt($row->id);
                    return $btn;
                })
                ->editColumn('hintDiscount', function (Level $level) {
                    return ($level->hintDiscount * 100) . '%';
                })
                ->make(true);
        }

        return view('judge.levels.list');
    }

    /**
     * Obtener Nivel
     *
     * Funcion para obtener el nivel por ID y devolver un JSON
     *
     * @param Request $request Peticion
     * @return JSON
     * @throws conditon
     **/
    public function get(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = decrypt($request->id);
            } catch (DecryptException $th) {
                $id = 0;
            }

            $level = Level::find($id);

            if (is_null($level)) {
                return response()->json(null);
            }

            return response()->json($level);
        } else {
            return response()->json(null);
        }
    }

    /**
     * Guardar Nivel
     *
     * Funcion para Guardar un nuevo Nivel
     *
     * @param  Request $request Peticion
     * @return JSON
     * @throws \Throwable
     **/
    public function store(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax()) {
            $resp["status"] = true;
            try {

                $level = new Level();

                $validation = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:25',
                        'score' => 'required|numeric|min:0',
                        'hintDiscount' => 'required|numeric|max:100|min:0',
                        'order' => 'required|numeric',
                        'idCompetition' => 'required',
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

                $id_competition = decrypt($request->idCompetition);

                $level->idCompetition = $id_competition;
                $level->name = $request->name;
                $level->score = $request->score;
                $level->hintDiscount = (float) round(($request->hintDiscount / 100), 2);
                $level->order = $request->order;

                $level->saveOrFail();
            } catch (\Throwable $ex) {
                $resp["status"] = false;
                $resp["msgError"] = $ex->getMessage();
            } finally {
                return response()->json($resp);
            }
        } else {
            return response()->json(['status' => false, 'msgError' => 'No se pudo procesar la peticion']);
        }
    }

    /**
     * Modificar Nivel
     *
     * Funcion para Modificar el nivel
     *
     * @param  Request $request Peticion
     * @return JSON
     * @throws \Throwable
     **/
    public function update(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax()) {
            $resp["status"] = true;
            try {
                if (!$request->has('id')) {
                    throw new \Exception("Nivel no encontrado");
                }

                $id = $request->id;

                $level = Level::find($id);

                if (is_null($level)) {
                    throw new \Exception("Nivel no encontrado");
                }

                $validation = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:25',
                        'score' => 'required|numeric|min:0',
                        'hintDiscount' => 'required|numeric|max:100|min:0',
                        'order' => 'required|numeric',
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

                $level->name = $request->name;
                $level->score = $request->score;
                $level->hintDiscount = (float) round(($request->hintDiscount / 100), 2);
                $level->order = $request->order;

                $level->saveOrFail();
            } catch (\Throwable $ex) {
                $resp["status"] = false;
                $resp["msgError"] = $ex->getMessage();
            } finally {
                return response()->json($resp);
            }
        } else {
            return response()->json(['status' => false, 'msgError' => 'No se pudo procesar la peticion']);
        }
    }

    /**
     * Eliminar Nivel
     *
     * Funcion para Eliminar el nivel
     *
     * @param  Request $request Peticion
     * @return JSON
     * @throws \Throwable
     **/
    public function delete(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax()) {
            $resp["status"] = true;
            try {
                if (!$request->has('id')) {
                    throw new \Exception("Nivel no encontrado");
                }

                $id = decrypt($request->id);

                $level = Level::find($id);

                if (is_null($level)) {
                    throw new \Exception("Nivel no encontrado");
                }

                $level->delete();
            } catch (\Throwable $ex) {
                $resp["status"] = false;
                if ($ex->getCode() == 1451) {
                    $resp["msgError"] = "El registro tiene retos relacionados";
                } else {
                    $resp["msgError"] = $ex->getMessage();
                }
            } finally {
                return response()->json($resp);
            }
        } else {
            return response()->json(['status' => false, 'msgError' => 'No se pudo procesar la peticion']);
        }
    }


    /**
     * Obtener todos Niveles
     *
     * Funciona para obtener todos los niveles.
     *
     * @param Request $request Peticion
     * @return JSON
     **/
    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $levels = Level::orderBy('name', 'asc')->get();
            return response()->json($levels);
        }
    }
}
