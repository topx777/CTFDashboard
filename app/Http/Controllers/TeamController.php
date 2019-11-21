<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Funcion list
     *
     * Funcion para listar los Usuarios (Equipo)
     *
     * @return view
     **/
    public function list()
    {
        return view('admin.teams.list');
    }

    /**
     * funciion register
     *
     * Funcion para registrar los Usuarios (Equipo)
     *
     * @return view
     **/
    public function register()
    {
        return view('admin.teams.register');
    }
}
