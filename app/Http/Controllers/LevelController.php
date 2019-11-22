<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;

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

            if ($request->has('search') && !is_null($request->search["value"])) {
                $search = $request->search["value"];

                $data = Level::where('name', 'LIKE', "%$search%")->get();
            } else {
                $data = Level::all();
            }

            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $btn = $row->id;
                    return $btn;
                })
                ->make(true);
        }
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
            $id = $request->id;

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

                $validation = $request->validate([
                    'name' => 'required|max:25',
                    'score' => 'required|numeric|min:0',
                    'hintDiscount' => 'required|numeric|max:100|min:0',
                ]);

                if ($validation->fails()) {
                    $resp["validationErrors"] = $validation->errors()->all();
                    throw new \Exception("Problemas de Validación");
                }

                $level->name = $request->name;
                $level->score = $request->score;
                $level->hintDiscount = $request->hintDiscount;

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
                    throw new Exception("Nivel no encontrado");
                }

                $id = $request->id;

                $level = Level::find($id);

                if (is_null($level)) {
                    throw new Exception("Nivel no encontrado");
                }

                $validation = $request->validate([
                    'name' => 'required|max:25',
                    'score' => 'required|numeric|min:0',
                    'hintDiscount' => 'required|numeric|max:100|min:0',
                ]);

                if ($validation->fails()) {
                    $resp["validationErrors"] = $validation->errors()->all();
                    throw new \Exception("Problemas de Validación");
                }

                $level->name = $request->name;
                $level->score = $request->score;
                $level->hintDiscount = $request->hintDiscount;

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
                    throw new Exception("Nivel no encontrado");
                }

                $id = $request->id;

                $level = Level::find($id);

                if (is_null($level)) {
                    throw new Exception("Nivel no encontrado");
                }

                $level->delete();
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
