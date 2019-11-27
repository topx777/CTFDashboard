<?php

use Illuminate\Database\Seeder;

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
            'score' => 0,
            'hintDiscount' => 1.5,
            'order' => 1
        ]);
        DB::table('levels')->insert([
            'id' => 2,
            'name' => 'Nivel 2',
            'score' => 0,
            'hintDiscount' => 2.5,
            'order' => 2
        ]);
        DB::table('levels')->insert([
            'id' => 3,
            'name' => 'Nivel 2',
            'score' => 0,
            'hintDiscount' => 3.3,
            'order' => 3
        ]);
        DB::table('levels')->insert([
            'id' => 4,
            'name' => 'Nivel 3',
            'score' => 0,
            'hintDiscount' => 4.1,
            'order' => 4
        ]);
        DB::table('levels')->insert([
            'id' => 5,
            'name' => 'Nivel 4',
            'score' => 0,
            'hintDiscount' => 5.2,
            'order' => 5
        ]);
        DB::table('levels')->insert([
            'id' => 6,
            'name' => 'Nivel 5',
            'score' => 0,
            'hintDiscount' => 6.1,
            'order' => 6
        ]);
    }
}
