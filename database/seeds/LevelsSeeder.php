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
            'score' => 0,
            'hintDiscount' => 1.5
        ]);
        DB::table('levels')->insert([
            'id' => 2,
            'score' => 0,
            'hintDiscount' => 2.5
        ]);
        DB::table('levels')->insert([
            'id' => 3,
            'score' => 0,
            'hintDiscount' => 3.3
        ]);
        DB::table('levels')->insert([
            'id' => 4,
            'score' => 0,
            'hintDiscount' => 4.1
        ]);
        DB::table('levels')->insert([
            'id' => 5,
            'score' => 0,
            'hintDiscount' => 5.2
        ]);
        DB::table('levels')->insert([
            'id' => 6,
            'score' => 0,
            'hintDiscount' => 6.1
        ]);
    }
}
