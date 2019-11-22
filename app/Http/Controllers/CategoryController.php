<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Listar Categorias
     *
     * Funciona para listar Categorias con busqueda, con DataTables AJAX
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

                $data = Category::where('name', 'LIKE', "%$search%")->get();
            } else {
                $data = Category::all();
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
     * Obtener Categori
     *
     * Funcion para obtener el Categori por ID y devolver un JSON
     *
     * @param Request $request Peticion
     * @return JSON
     * @throws conditon
     **/
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $category = Category::find($id);

            if (is_null($category)) {
                return response()->json(null);
            }

            return response()->json($category);
        } else {
            return response()->json(null);
        }
    }

    /**
     * Guardar Categoria
     *
     * Funcion para Guardar un nuevo Categoria
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

                $category = new Category();

                $validation = $request->validate([
                    'name' => 'required|max:30',
                    'description' => 'required',
                ]);

                if ($validation->fails()) {
                    $resp["validationErrors"] = $validation->errors()->all();
                    throw new \Exception("Problemas de Validación");
                }

                $category->name = $request->name;
                $category->description = $request->description;

                $category->saveOrFail();
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
     * Modificar Categori
     *
     * Funcion para Modificar el Categori
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
                    throw new Exception("Categoria no encontrado");
                }

                $id = $request->id;

                $category = Category::find($id);

                if (is_null($category)) {
                    throw new Exception("Categoria no encontrado");
                }

                $validation = $request->validate([
                    'name' => 'required|max:30',
                    'description' => 'required',
                ]);

                if ($validation->fails()) {
                    $resp["validationErrors"] = $validation->errors()->all();
                    throw new \Exception("Problemas de Validación");
                }

                $category->name = $request->name;
                $category->description = $request->description;

                $category->saveOrFail();
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
     * Eliminar Categoria
     *
     * Funcion para Eliminar el Categoria
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
                    throw new Exception("Categoria no encontrado");
                }

                $id = $request->id;

                $category = Category::find($id);

                if (is_null($category)) {
                    throw new Exception("Categoria no encontrado");
                }

                $category->delete();
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
     * Obtener todos Categorias
     *
     * Funciona para obtener todos los Categorias.
     *
     * @param Request $request Peticion
     * @return JSON
     **/
    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $categorys = Category::orderBy('name', 'asc')->get();
            return response()->json($categorys);
        }
    }
}
