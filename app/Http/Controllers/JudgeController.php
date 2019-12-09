<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Judge;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JudgeController extends Controller
{
    /**
     * function list
     *
     * lista los jueces de CTf
     *  
     * @return View
     * @throws conditon
     **/
    public function list(Request $request)
    {
        if ($request->ajax()) {
            if($request->has('search') && !is_null($request->search['value'])) {
                $search = $request->search['value'];
                $data = Judge::where('name', 'LIKE', "%{$search}%");

            }
            else {
                $data=Judge::all();
            }

            return DataTables::of($data)
                ->addColumn('DT_RowId', function($row)
                {
                    $row=$row->id;
                    return $row;
                })->make(true);
        }
        return view('admin.judges.list');
    }

     /**
     * Obtener un juez
     *
     * Funcion para obtener un juez por ID (Administrador)
     *
     * @return JSON
     **/
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $judge = Judge::with('User')->find($id);

            if (is_null($judge)) {
                return response()->json(null);
            }

            return response()->json($judge);
        } else {
            return response()->json(null);
        }
    }

    /**
     * registra un juez
     *
     * Funcion para registrar un nuevo juez
     *
     * @return JSON
     **/
    public function store(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax()) {
            $resp['status']=true;
            try {
                $judge =new Judge();
                $validation= Validator::make(
                    $request->all(),[
                        'name' => 'required|max:40'
                    ]
                );

                if ($validation->fails()) {
                    $resp['validationErrors']= $validation->errors()->all();
                    throw new \Exception('Problemas de validacion');
                }


            } catch (\Throwable $th) {

            }
        }
    }


    /**
     * funcion register
     *
     * Funcion para mostrar la vista de registro de los juez (Administrador)
     *
     * @return view
     **/
    public function register()
    {
        return view('admin.judges.register');
    }

    /**
     * Detalle de juez
     *
     * Vista de dEtalle de un juez
     *
     * @param Int $id Id de juez
     * @return view
     **/
    public function detail(Request $request, $id)
    {
        return view('admin/judges/details',['id'=>$id]);
    }

    /**
     * Funcion para Modificar un juez
     *
     * Modificar el juez
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
                $id = $request->judge['idJudge'];
                $judge = Judge::with('User')->find($id);

                if (is_null($judge)) {
                    throw new \Exception("No se encontro al juez");
                }
                
                $validateJudge = Validator::make(
                    $request->judge,
                    [
                        'name' =>'required|max:40',
                        'lastname' => 'required|max:55',
                        'username' => 'required|unique:users|max:40',
                        'email' => 'required|unique:users|max:55|email',
                        'password' => 'required|max:35'
                    ]
                );

                $validationErrorsJudge = [];
                if ($validateJudge->fails()) {
                    foreach ($validateJudge->getMessageBag()->getMessages() as $key => $error) {
                        $validationErrorsJudge[$key] = $error;
                    }
                    $resp["errors"] = $validationErrorsJudge;
                    throw new \Exception("Existen Errores de Validacion");
                }

                $judge->name=$request->name;
                $judge->lastname=$request->lastname;
                $judge->User->username=$request->username;
                $judge->User->password=($request->password=='null')?$judge->User->password:Hash::make($request->password);
                $judge->User->email=$request->email;
                $judge->saveOrFail();
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
     * Funcion para Eliminar el juez
     *
     * Eliminar el juez
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
                $judge = Judge::find($id);

                if (is_null($judge)) {
                    throw new \Exception("No se encontro al juez");
                }
                $judge->delete();
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
