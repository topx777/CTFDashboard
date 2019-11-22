<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class UserController extends Controller
{
    /**
     * Funcion list
     *
     * Funcion para listar los Usuarios (Administrador)
     *
     * @return view
     **/
    public function list(Request $request)
    {
        if ($request->ajax()) {

            if ($request->has('search') && !is_null($request->search["value"])) {
                $search = $request->search["value"];

                $data = User::where('username', 'LIKE', "%$search%")
                    ->where('admin', 1)->get();
            } else {
                $data = User::where('admin', 1)->get();
            }

            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $btn =$row->id;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.list');
    }


    /**
     * Funcion list
     *
     * Funcion para listar los Usuarios (Administrador)
     *
     * @return view
     **/
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $user = User::find($id);

            if (is_null($user)) {
                return response()->json(null);
            }

            return response()->json($user);
        } else {
            return response()->json(null);
        }
    }


    /**
     * funcion register
     *
     * Funcion para mostrar la vista de registro de los Usuarios (Administrador)
     *
     * @return view
     **/
    public function register()
    {
        return view('admin.users.register');
    }

    /**
     * Funcion para Modificar Usuario
     *
     * Modificar el usuario
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
                $user = User::find($id);

                if (is_null($user)) {
                    throw new \Exception("No se encontro al usuario");
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

                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);

                $user->saveOrFail();
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
     * Funcion para Eliminar el Usuario
     *
     * Eliminar el usuario
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
                $user = User::find($id);

                if (is_null($user)) {
                    throw new \Exception("No se encontro al usuario");
                }
                $user->delete();
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
