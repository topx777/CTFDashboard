<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // COMPETENCIA 1
        // Team 1
        DB::table('teams')->insert([
            'id' => 1,
            'idUser' => 3,
            'name' => 'TEAM1',
            'score' => 0,
            'phrase' => 'Fr453 T34M.1',
            'avatar' => 'avatar',
            'couch' => 'Couch Team1',
            'teamPassword' => 'team1abc',
            'idCompetition' => 1
        ]);
        // Team 2
        DB::table('teams')->insert([
            'id' => 2,
            'idUser' => 4,
            'name' => 'TEAM2',
            'score' => 0,
            'phrase' => 'Fr453 T34M.2',
            'avatar' => 'avatar',
            'couch' => 'Couch Team2',
            'teamPassword' => 'team1abc',
            'idCompetition' => 1
        ]);
        // Team 3
        DB::table('teams')->insert([
            'id' => 3,
            'idUser' => 5,
            'name' => 'TEAM3',
            'score' => 0,
            'phrase' => 'Fr453 T34M.3',
            'avatar' => 'avatar',
            'couch' => 'Couch Team3',
            'teamPassword' => 'team1abc',
            'idCompetition' => 1
        ]);
        // Team 4
        DB::table('teams')->insert([
            'id' => 4,
            'idUser' => 6,
            'name' => 'TEAM4',
            'score' => 0,
            'phrase' => 'Fr453 T34M.4',
            'avatar' => 'avatar',
            'couch' => 'Couch Team4',
            'teamPassword' => 'team1abc',
            'idCompetition' => 1
        ]);
    }
}
