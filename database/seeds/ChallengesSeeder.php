<?php

use Illuminate\Database\Seeder;

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
            'idLevel' => 1,
            'idCategory' => 1,
            'name' => 'CriptoMensajes',
            'description' => 'El reto trata de descriptar el mensaje en el siguiete mensaje',
            'hint' => 'Cr_pt_',
            'flag' => 'Cripto'
        ]);
        DB::table('challenges')->insert([
            'id' => 2,
            'idLevel' => 2,
            'idCategory' => 5,
            'name' => 'Creada un procedimiento almacenado',
            'description' => 'sintaxis para ingresar datos a una tabla',
            'hint' => 'i_s_rt in_o',
            'flag' => 'insert into'
        ]);
    }
}
