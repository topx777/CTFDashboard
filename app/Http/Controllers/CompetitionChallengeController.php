<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompetitionChallengeController extends Controller
{
    /**
     * Funcion list
     *
     * Funcion para listar los Retos de la Competencia
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
                ->editColumn('idLevel', function ($row) {
                    return $row->Level->name;
                })
                ->editColumn('idCategory', function ($row) {
                    return $row->Category->name;
                })
                ->rawColumns(['action', 'description'])
                ->make(true);
        }

        return view('judge.competitionChallenge.list');
    }
}
