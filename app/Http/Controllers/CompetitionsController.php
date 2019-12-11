<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use App\Events\ECompetitionScoreUpdate;
use Yajra\DataTables\Facades\DataTables;

class CompetitionsController extends Controller
{
    public function TeamsPositions(Request $request)
    {
        broadcast(new ECompetitionScoreUpdate(1));
        return response()->json(Competition::scoreboard(1));
    }
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
        $competitions=Competition::all();
        return view('admin.competitions.list',compact('competitions'));
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

            $competition = Competition::with(['Judge'])->find($id);

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
        return view('admin/competitions/details',['id'=>$id]);
    }

    /**
     * Deshabilitacion maestra de competicion
     *
     * Deshabilita o habilita una copetencia 
     *
     * @param Int $request->id id de competencia
     * @param Int $request->disable nuevo estado
     * @return JSON
     **/
    public function disable(Request $request)
    {
        $response["status"] = true;
        try {

            if (!$request->ajax()) {
                throw new \Exception("Error de peticion");
            }
            $id = $request->id;
            $competition = Competition::find($id);

            if (is_null($competition)) {
                throw new \Exception("Error, no se pudo encontrar la competicion");
            }
            $competition->masterDisabled=$request->disable;
            $competition->saveOrFail();
        } catch (\Throwable $ex) {
            $response["status"] = false;
            $response["msgError"] = $ex->getMessage();
        } finally {
            return response()->json($response);
        }
    }

    /**
     * deshabilita una lista de competencias
     *
     * deshabilita una lista de competencias
     *
     * @param Array $request->competitions arreglo de competiciones
     * @return JSON
     **/
    public function disableList(Request $request)
    {
        $response["status"] = true;
        try {

            if (!$request->ajax()) {
                throw new \Exception("Error de peticion");
            }
            $competitionsEnable=[];
            foreach ($request->competitions as $key => $competitionId) {
                $competition = Competition::find($competitionId);
                if (!is_null($competition)) {
                    $competition->masterDisabled=0;
                    $competition->saveOrFail();
                    $competition->fresh();
                    $competitionsEnable[]=$competition;
                }
            }
            $competitionsEnable=collect($competitionsEnable);

            $allCompetition=Competition::all();
            $competitionsDisable=$allCompetition->diff($competitionsEnable);

            foreach ($competitionsDisable as $key => $competition) {
                $competition->masterDisabled=1;
                $competition->saveOrFail();
            }


        } catch (\Throwable $ex) {
            $response["status"] = false;
            $response["msgError"] = $ex->getMessage();
        } 
        
        finally {
            return response()->json($response);
        }
    }

  

}
