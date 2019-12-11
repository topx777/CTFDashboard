<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChallengesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('challenges')->insert([
        //     'id' => 1,
        //     'idLevel' => 1,
        //     'idCategory' => 1,
        //     'name' => 'Nombre del Reto',
        //     'description' => 'Descripcion del reto',
        //     'hint' => 'Pista para el reto',
        //     'flag' => 'Respuesta del reto'
        // ]);
        // DB::table('challenges')->insert([
        //     'id' => 2,
        //     'idLevel' => 2,
        //     'idCategory' => 2,
        //     'name' => 'Nombre del Reto',
        //     'description' => 'Descripcion del reto',
        //     'hint' => 'Pista para el reto',
        //     'flag' => 'Respuesta del reto'
        // ]);
        // DB::table('challenges')->insert([
        //     'id' => 3,
        //     'idLevel' => 3,
        //     'idCategory' => 3,
        //     'name' => 'Nombre del Reto',
        //     'description' => 'Descripcion del reto',
        //     'hint' => 'Pista para el reto',
        //     'flag' => 'Respuesta del reto'
        // ]);
        // DB::table('challenges')->insert([
        //     'id' => 4,
        //     'idLevel' => 4,
        //     'idCategory' => 4,
        //     'name' => 'Nombre del Reto',
        //     'description' => 'Descripcion del reto',
        //     'hint' => 'Pista para el reto',
        //     'flag' => 'Respuesta del reto'
        // ]);
        // DB::table('challenges')->insert([
        //     'id' => 5,
        //     'idLevel' => 5,
        //     'idCategory' => 5,
        //     'name' => 'Nombre del Reto',
        //     'description' => 'Descripcion del reto',
        //     'hint' => 'Pista para el reto',
        //     'flag' => 'Respuesta del reto'
        // ]);
        DB::table('challenges')->insert([
            'id' => 1,
            'idCategory' => 1,
            'name' => 'CriptoMensajes',
            'description' => 'El reto trata de descriptar el mensaje en el siguiete mensaje',
            'hint' => 'Cr_pt_',
            'flag' => 'Cripto',
            'dificulty'=>'medio'
        ]);
        DB::table('challenges')->insert([
            'id' => 2,
            'idCategory' => 5,
            'name' => 'Creada un procedimiento almacenado',
            'description' => 'sintaxis para ingresar datos a una tabla',
            'hint' => 'i_s_rt in_o',
            'flag' => 'insert into',
            'dificulty'=>'medio'
        ]);
    }
}
