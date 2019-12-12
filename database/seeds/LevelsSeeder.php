<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('levels')->insert([
            'id' => 1,
            'name' => 'Nivel 1',
            'score' => 75,
            'hintDiscount' => 0.1,
            'order' => 1,
            'idCompetition' => 1
        ]);
        DB::table('levels')->insert([
            'id' => 2,
            'name' => 'Nivel 2',
            'score' => 90,
            'hintDiscount' => 0.15,
            'order' => 2,
            'idCompetition' => 1

        ]);
        DB::table('levels')->insert([
            'id' => 3,
            'name' => 'Nivel 3',
            'score' => 135,
            'hintDiscount' => 0.25,
            'order' => 3,
            'idCompetition' => 1

        ]);
        DB::table('levels')->insert([
            'id' => 4,
            'name' => 'Nivel 4',
            'score' => 175,
            'hintDiscount' => 0.35,
            'order' => 4,
            'idCompetition' => 1

        ]);
        DB::table('levels')->insert([
            'id' => 5,
            'name' => 'Nivel 5',
            'score' => 225,
            'hintDiscount' => 0.5,
            'order' => 5,
            'idCompetition' => 1
        ]);
    }
}
