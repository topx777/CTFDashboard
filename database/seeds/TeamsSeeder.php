<?php

use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('teams')->insert([
            'id' => 1,
            'idUser' => 1,
            'name' => 'CodigoFacilito',
            'score' => 0,
            'phrase' => 'Agachate y conocelo',
            'avatar' => 'direccion del equipo',
            'couch' => 'Yo mismo',
        ]);
        DB::table('teams')->insert([
            'id' => 2,
            'idUser' => 2,
            'name' => 'COCO',
            'score' => 0,
            'phrase' => 'Me traes un poco loco',
            'avatar' => 'direccion del equipo',
            'couch' => 'Nadie nos quiere',
        ]);
        DB::table('teams')->insert([
            'id' => 3,
            'idUser' => 3,
            'name' => 'HP',
            'score' => 0,
            'phrase' => 'OMEN',
            'avatar' => 'direccion del equipo',
            'couch' => 'Algun dia',
        ]);
        DB::table('teams')->insert([
            'id' => 4,
            'idUser' => 4,
            'name' => 'Legion',
            'score' => 0,
            'phrase' => 'Arrodillate ante la legion',
            'avatar' => 'direccion del equipo',
            'couch' => 'Merlin',
        ]);
        DB::table('teams')->insert([
            'id' => 5,
            'idUser' => 5,
            'name' => 'PC Master',
            'score' => 0,
            'phrase' => 'Mas de 60FPS',
            'avatar' => 'direccion del equipo',
            'couch' => 'Patrocinadores',
        ]);
        DB::table('teams')->insert([
            'id' => 6,
            'idUser' => 6,
            'name' => 'USB',
            'score' => 0,
            'phrase' => 'Nos podemos conectar',
            'avatar' => 'direccion del equipo',
            'couch' => 'Transporte',
        ]);
    }
}
