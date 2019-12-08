<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
        return view('judge\files\list');
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
        $resp["status"] = true;
        try {
            if (!$request->ajax()) {
                throw new \Exception("No se pudo procesar la peticion");
            }

            $validationData = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'file' => 'required|file|max:10000'
                ]
            );

            if ($validationData->fails()) {
                $validationErrors = [];

                foreach ($validationData->getMessageBag()->getMessages() as $key => $error) {
                    $validationErrors[$key] = $error;
                }

                $resp["errors"] = $validationErrors;

                throw new \Exception("Error de validacion");
            }

            $fileobj = $request->file('file');

            $file_name = $fileobj->getClientOriginalName();
            $file_extension = $fileobj->getClientOriginalExtension();
            $file_size = $fileobj->getClientSize();

            $path = time() . $file_name;

            $file_uploaded = $fileobj->storeAs('public/files', $path);
            if (!$file_uploaded) {
                throw new \Exception("No se puede subir el archivo");
            }

            $file = new File();
            $file->name = $request->name;
            $file->size = $file_size;
            $file->ext = $file_extension;
            $file->upload_date = Carbon::now();

            $file->path = $file_uploaded;
            $imageUrl = asset(Storage::disk('local')->url($file_uploaded));
            $file->url = $imageUrl;

            if (!$file->save()) {
                Storage::disk('local')->delete($file_uploaded);
                throw new \Exception("No se pudo subir el archivo");
            }

            $resp["file"] = $file;
        } catch (\Throwable $ex) {
            $resp["status"] = false;
            $resp["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($resp);
        }
    }

    /**
     * Eliminar Archivo
     *
     * Funcion para eliminar el archivo
     *
     * @param Request $request Peticion
     * @return JSON
     * @throws Throwable
     **/
    public function delete(Request $request)
    {
        $resp["status"] = true;
        try {
            if (!$request->ajax()) {
                throw new \Exception("No se pudo procesar la peticion");
            }

            if (!$request->has('id')) {
                throw new \Exception("No se encontro el archivo");
            }

            $file = File::find($request->id);

            if (is_null($file)) {
                throw new \Exception("No se encontro el archivo");
            }

            $path = $file->path;

            if ($file->delete()) {
                Storage::disk('local')->delete($path);
            }
        } catch (\Throwable $ex) {
            $resp["status"] = false;
            $resp["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($resp);
        }
    }
}
