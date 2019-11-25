<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use DataTables;

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
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.challenges.list');
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
    public function detail(Request $request)
    {
        return view('admin.teams.detail');
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
        return view('admin.teams.register');
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
}
