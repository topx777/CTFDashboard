<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CompetitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('competitions')->insert([
            'id'=>1,
            'name'=>'CompeticionCTF1',
            'state'=>false,
            'masterDisabled'=>false,
            'rules'=> 'Reglas de CTF1',
            'startTime'=>Carbon::now()->format('Y-m-d H:i:s'),
            'endTime'=>Carbon::now()->format('Y-m-d H:i:s'),
            'idJudge'=>1,
            'dificulty'=>1,
            'unlockType'=>1,
            'gameMode'=>0,
        ]);
        DB::table('competitions')->insert([
            'id'=>2,
            'name'=>'CompeticionCTF2',
            'state'=>false,
            'masterDisabled'=>false,
            'rules'=> 'Reglas de CTF2',
            'startTime'=>Carbon::now()->format('Y-m-d H:i:s'),
            'endTime'=>Carbon::now()->format('Y-m-d H:i:s'),
            'idJudge'=>1,
            'dificulty'=>1,
            'unlockType'=>1,
            'gameMode'=>0,
        ]);
        DB::table('competitions')->insert([
            'id'=>3,
            'name'=>'CompeticionCTF3',
            'state'=>false,
            'masterDisabled'=>false,
            'rules'=> 'Reglas de CTF3',
            'startTime'=>Carbon::now()->format('Y-m-d H:i:s'),
            'endTime'=>Carbon::now()->format('Y-m-d H:i:s'),
            'idJudge'=>1,
            'dificulty'=>1,
            'unlockType'=>1,
            'gameMode'=>0,
        ]);
        DB::table('competitions')->insert([
            'id'=>4,
            'name'=>'CompeticionCTF4',
            'state'=>false,
            'masterDisabled'=>false,
            'rules'=> 'Reglas de CTF4',
            'startTime'=>Carbon::now()->format('Y-m-d H:i:s'),
            'endTime'=>Carbon::now()->format('Y-m-d H:i:s'),
            'idJudge'=>1,
            'dificulty'=>1,
            'unlockType'=>1,
            'gameMode'=>0,
        ]);
    }
}
