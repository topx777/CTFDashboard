<?php

use Illuminate\Database\Seeder;

class levels extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            'id'=> 1,
            'score'=> 100,
            'hintDiscount'=> 1
        ]);

        DB::table('levels')->insert([
            'id'=> 2,
            'score'=> 200,
            'hintDiscount'=> 2
        ]);

        DB::table('levels')->insert([
            'id'=> 3,
            'score'=> 300,
            'hintDiscount'=> 3
        ]);

        DB::table('levels')->insert([
            'id'=> 4,
            'score'=> 400,
            'hintDiscount'=> 4
        ]);
    }
}
