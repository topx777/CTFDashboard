<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }

    /**
     * Mustra el dashboar de Judge
     *
     * @return \Illuminate\Contracts\Support\Renderable
     **/
    public function judgeIndex()
    {
        return view('judge.home');
    }


    /**
     * Muestra el registro de invitado por competencia
     * 
     * @param Request $request Peticion
     * @return Renderable
     */
    public function registerTeam(Request $request)
    {
        return view('auth.register');
    }
}
