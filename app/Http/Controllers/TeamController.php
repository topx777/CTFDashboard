<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use DataTables;

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

            if ($request->has('search') && !is_null($request->search["value"])) {
                $search = $request->search["value"];

                $data = Team::where('name', 'LIKE', "%$search%")->get();
            } else {
                $data = Team::all();
            }

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Editar" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Eliminar" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.teams.list');
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
        if ($request->ajax()) {
            $id = $request->id;

            $team = Team::find($id);

            if (is_null($team)) {
                return response()->json(null);
            }

            return response()->json($team);
        } else {
            return response()->json(null);
        }
    }


    /**
     * funcion register
     *
     * Funcion para mostrar la vista de registro de los equipos (Administrador)
     *
     * @return view
     **/
    public function register()
    {
        return view('admin.teams.register');
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
            $resp["status"] = true;
            try {
                $id = $request->id;
                $team = Team::find($id);

                if (is_null($team)) {
                    throw new \Exception("No se encontro al equipo");
                }

                $validateUser = $request->validate([
                    'username' => 'required|unique:users|max:255',
                    'email' => 'required|unique:users|max:255|email',
                    'password' => 'required'
                ]);


                if ($validateUser->fails()) {
                    $validationErrors = [];

                    foreach ($validateUser->errors->all() as $error) {
                        $validationErrors[] = $error;
                    }
                    $resp["validateErrors"] = $validationErrors;
                    throw new Exception("Existen Errores de Validacion");
                }

                $team->username = $request->username;
                $team->email = $request->email;
                $team->password = Hash::make($request->password);

                $team->saveOrFail();
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
                $id = $request->id;
                $team = Team::find($id);

                if (is_null($team)) {
                    throw new \Exception("No se encontro al equipo");
                }
                $team->delete();
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
