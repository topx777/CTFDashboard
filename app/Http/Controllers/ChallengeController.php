<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use DataTables;
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
                ->rawColumns(['action', 'description'])
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
    public function detail($id)
    {
        $challenge = Challenge::find($id);

        if (is_null($challenge)) {
            abort('500', 'No se encontro el reto');
        }

        return view('admin.challenges.detail', compact('challenge'));
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
        return view('admin.challenges.register');
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
                    'idLevel' => 'required',
                    'idCategory' => 'required'
                ]
            );

            if ($validation->fails()) {
                $validationErrors = [];

                foreach ($validation->getMessageBag()->getMessages() as $key => $error) {
                    $validationErrors[$key][] = $error;
                }

                $resp["errors"] = $validationErrors;
                throw new \Exception("Errores de Validacion");
            }

            $challenge = new Challenge();

            $challenge->idLevel = $request->idLevel;
            $challenge->idCategory = $request->idCategory;
            $challenge->name = $request->name;
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

        return view('admin.challenges.edit', compact('challenge'));
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
                    'idLevel' => 'required',
                    'idCategory' => 'required'
                ]
            );

            if ($validation->fails()) {
                $validationErrors = [];

                foreach ($validation->getMessageBag()->getMessages() as $key => $error) {
                    $validationErrors[$key][] = $error;
                }

                $resp["errors"] = $validationErrors;
                throw new \Exception("Errores de Validacion");
            }

            $challenge = Challenge::find($request->id);

            if (is_null($challenge)) {
                throw new \Exception("No se encontro el reto");
            }

            $challenge->idLevel = $request->idLevel;
            $challenge->idCategory = $request->idCategory;
            $challenge->name = $request->name;
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
}
