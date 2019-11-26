<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Throwable;

class FileController extends Controller
{
    //

    /**
     * Mostrar Archivos
     *
     * Funcion para Mostrar todos los archivos
     *
     * @return View
     **/
    public function list()
    {
        return view('admin\files\list');
    }

    /**
     * Obtener Archivos
     *
     * Funcion para Obtener todos los archivos y devolver en JSON
     *
     * @param Request $var Description
     * @return JSON
     **/
    public function getAll(Request $request)
    {
        if ($request->ajax()) {

            $files = File::orderBy('upload_date', 'DESC')->get();

            return $files;
        } else {
            return response()->json([]);
        }
    }


    /**
     * Subir Archivo
     *
     * FUncion para subir archivo al servidor
     *
     * @param Request $request Peticion
     * @return JSON
     * @throws \Throwable
     **/
    public function upload(Request $request)
    {
        $resp["status"] = false;
        try { } catch (\Throwable $ex) {
            $resp["status"] = false;
            $resp["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($resp);
        }
    }
}
