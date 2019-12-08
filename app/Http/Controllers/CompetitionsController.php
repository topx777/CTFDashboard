<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use Yajra\DataTables\Facades\DataTables;

class CompetitionsController extends Controller
{
        /**
     * function list
     *
     * lista las competicions de CTf
     *  
     * @return View
     * @throws conditon
     **/
    public function list(Request $request)
    {
        if ($request->ajax()) {
            if($request->has('search') && !is_null($request->search['value'])) {
                $search = $request->search['value'];
                $data = Competition::where('name', 'LIKE', "%{$search}%");

            }
            else {
                $data=Competition::all();
            }

            return DataTables::of($data)
                ->addColumn('DT_RowId', function($row)
                {
                    $row=$row->id;
                    return $row;
                })->make(true);
        }
        return view('admin.competitions.list');
    }

     /**
     * Obtener una competicion
     *
     * Funcion para obtener una competencia  por ID (Administrador)
     *
     * @return JSON
     **/
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $competition = Competition::find($id);

            if (is_null($competition)) {
                return response()->json(null);
            }

            return response()->json($competition);
        } else {
            return response()->json(null);
        }
    }

    /**
     * Detalle de competencia
     *
     * Vista de detalle de una competencia
     *
     * @param Int $id Id de Competencia
     * @return view
     **/
    public function detail(Request $request, $id)
    {
        return view('admin/competitions/details');
    }

  

}
