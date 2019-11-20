<?php

use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tiempo = new DateTime();
        DB::table('options')->insert([
            'id' => 1,
            'state' => false,
            'rules' => 'Reglas del juego',
            'startTime' => $tiempo,
            'endTime' => $tiempo
        ]);
        DB::table('options')->insert([
            'id' => 2,
            'state' => false,
            'rules' => 'Reglas del juego',
            'startTime' => $tiempo,
            'endTime' => $tiempo
        ]);
        DB::table('options')->insert([
            'id' => 3,
            'state' => false,
            'rules' => 'Reglas del juego',
            'startTime' => $tiempo,
            'endTime' => $tiempo
        ]);
    }
}
