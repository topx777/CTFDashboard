<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Funcion list
     *
     * Funcion para listar los Usuarios (Administrador)
     *
     * @return view
     **/
    public function list()
    {
        return view('admin.users.list');
    }

    /**
     * funciion register
     *
     * Funcion para registrar los Usuarios (Administrador)
     *
     * @return view
     **/
    public function register()
    {
        return view('admin.users.register');
    }
}
