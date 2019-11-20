<?php

use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //HABRA 1 MIEMBRO POR CADA TEAMA
        DB::table('members')->insert([
            'id' => 1,
            'idTeam' => 1,
            'name' => 'Mauricio',
            'lastname' => 'Gamarra',
            'email' => 'mauriciogamarra@gmail.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 2,
            'idTeam' => 2,
            'name' => 'Abel',
            'lastname' => 'Lopez',
            'email' => 'abellopez@gmail.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 3,
            'idTeam' => 3,
            'name' => 'Pablo',
            'lastname' => 'Pablo',
            'email' => 'pablo@gmail.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 4,
            'idTeam' => 4,
            'name' => 'Christopher',
            'lastname' => 'Huanca',
            'email' => 'christopher@gmail.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 5,
            'idTeam' => 5,
            'name' => 'Rodrigo',
            'lastname' => 'Huanca',
            'email' => 'rodrigo@gmail.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 6,
            'idTeam' => 6,
            'name' => 'Luis',
            'lastname' => 'Uscamayta',
            'email' => 'luis@gmail.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
    }
}
