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
        DB::table('challenges')->insert([
            'id' => 1,
            'idCategory' => 1,
            'name' => 'Reto A',
            'description' => 'Descripcion del reto',
            'hint' => 'Pista para el reto',
            'flag' => 'flag',
            'dificulty' => 'extrema'
        ]);
        DB::table('challenges')->insert([
            'id' => 2,
            'idCategory' => 2,
            'name' => 'Reto B',
            'description' => 'Descripcion del reto',
            'hint' => 'Pista para el reto',
            'flag' => 'flag',
            'dificulty' => 'dificl'
        ]);
        DB::table('challenges')->insert([
            'id' => 3,
            'idCategory' => 3,
            'name' => 'Reto C',
            'description' => 'Descripcion del reto',
            'hint' => 'Pista para el reto',
            'flag' => 'flag',
            'dificulty' => 'facil'
        ]);
        DB::table('challenges')->insert([
            'id' => 4,
            'idCategory' => 4,
            'name' => 'Reto D',
            'description' => 'Descripcion del reto',
            'hint' => 'Pista para el reto',
            'flag' => 'flag',
            'dificulty' => 'medio'
        ]);
        DB::table('challenges')->insert([
            'id' => 5,
            'idCategory' => 3,
            'name' => 'Reto E',
            'description' => 'Descripcion del reto',
            'hint' => 'Pista para el reto',
            'flag' => 'flag',
            'dificulty' => 'medio'
        ]);
        DB::table('challenges')->insert([
            'id' => 6,
            'idCategory' => 1,
            'name' => 'Reto F',
            'description' => 'El reto trata de descriptar el mensaje en el siguiete mensaje',
            'hint' => 'Cr_pt_',
            'flag' => 'flag',
            'dificulty' => 'extrema'
        ]);
        DB::table('challenges')->insert([
            'id' => 7,
            'idCategory' => 4,
            'name' => 'Reto G',
            'description' => 'sintaxis para ingresar datos a una tabla',
            'hint' => 'i_s_rt in_o',
            'flag' => 'flag',
            'dificulty' => 'facil'
        ]);
        DB::table('challenges')->insert([
            'id' => 8,
            'idCategory' => 3,
            'name' => 'Reto H',
            'description' => 'sintaxis para ingresar datos a una tabla',
            'hint' => 'i_s_rt in_o',
            'flag' => 'flag',
            'dificulty' => 'medio'
        ]);
        DB::table('challenges')->insert([
            'id' => 9,
            'idCategory' => 2,
            'name' => 'Reto I',
            'description' => 'sintaxis para ingresar datos a una tabla',
            'hint' => 'i_s_rt in_o',
            'flag' => 'flag',
            'dificulty' => 'dificil'
        ]);
        DB::table('challenges')->insert([
            'id' => 10,
            'idCategory' => 2,
            'name' => 'Reto J',
            'description' => 'sintaxis para ingresar datos a una tabla',
            'hint' => 'i_s_rt in_o',
            'flag' => 'flag',
            'dificulty' => 'dificil'
        ]);
        DB::table('challenges')->insert([
            'id' => 11,
            'idCategory' => 1,
            'name' => 'Reto M',
            'description' => 'sintaxis para ingresar datos a una tabla',
            'hint' => 'i_s_rt in_o',
            'flag' => 'flag',
            'dificulty' => 'dificil'
        ]);
        DB::table('challenges')->insert([
            'id' => 12,
            'idCategory' => 3,
            'name' => 'Reto N',
            'description' => 'sintaxis para ingresar datos a una tabla',
            'hint' => 'i_s_rt in_o',
            'flag' => 'flag',
            'dificulty' => 'facil'
        ]);
    }
}
