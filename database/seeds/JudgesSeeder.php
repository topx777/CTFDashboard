<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JudgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('judges')->insert([
            'id' => 1,
            'idUser'=>2,//Abel
            'name'=>'NomJuez1',
            'lastname'=>'ApJuez1'
        ]);
    }
}
