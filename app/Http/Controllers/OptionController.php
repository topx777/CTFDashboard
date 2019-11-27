<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Option;
use Carbon\Carbon;
use Throwable;

class OptionController extends Controller
{
    /**
     * Mostrar Opciones
     *
     * Funcion para Mostrar las opciones de la aplicacion
     *
     * @return View
     **/
    public function show()
    {
        $option = Option::first();

        if (is_null($option)) {
            $option = new Option();
            $option->state = 0;
            $option->rules = "Reglas Iniales";
            $option->startTime = Carbon::now();
            $option->endTime = Carbon::now();
        }

        return view('admin.options.options', compact('option'));
    }

    /**
     * Editar las Opciones
     *
     * Fncion para Editar las opciones
     *
     * @param Request $request Peticion
     * @return JSON
     * @throws Throwable
     **/
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $resp["status"] = true;
            try {
                if (!$request->has('id')) {
                    throw new \Exception("No se encontro las opciones");
                }

                $id = $request->id;

                $option = Option::find($id);
                if (is_null($option)) {
                    throw new \Exception("No se encontro las opciones");
                }

                $option->state = $request->state;
                $option->rules = $request->rules;
                $option->startTime = Carbon::createFromFormat('d/m/Y H:i', $request->startDate);
                $option->endTime = Carbon::createFromFormat('d/m/Y H:i', $request->endDate);

                $option->saveOrFail();
            } catch (\Throwable $ex) {
                $resp["status"] = false;
                $resp["msgError"] = $ex->getMessage();
            } finally {
                return response()->json($resp);
            }
        } else {
            return response()->json(["status" => false, "msgError" => "Error al procesar la peticion"]);
        }
    }
}
