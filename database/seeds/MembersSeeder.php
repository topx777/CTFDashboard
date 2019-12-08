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
        // Competencia 1
        // Miembros team1 *3
        DB::table('members')->insert([
            'id' => 1,
            'idTeam' => 1,
            'name' => 'NombreMem1T1',
            'lastname' => 'ApMem1T1',
            'email' => 'NombreMem1T1@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 2,
            'idTeam' => 1,
            'name' => 'NombreMem2T1',
            'lastname' => 'ApMem2T1',
            'email' => 'NombreMem2T1@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 3,
            'idTeam' => 1,
            'name' => 'NombreMem3T1',
            'lastname' => 'ApMem3T1',
            'email' => 'NombreMem3T1@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);

        // Miembros team2
        DB::table('members')->insert([
            'id' => 4,
            'idTeam' => 2,
            'name' => 'NombreMem1T2',
            'lastname' => 'ApMem1T2',
            'email' => 'NombreMem1T2@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 5,
            'idTeam' => 2,
            'name' => 'NombreMem2T2',
            'lastname' => 'ApMem2T2',
            'email' => 'NombreMem2T2@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 6,
            'idTeam' => 2,
            'name' => 'NombreMem3T2',
            'lastname' => 'ApMem3T2',
            'email' => 'NombreMem3T2@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        // Miembros team3
        DB::table('members')->insert([
            'id' => 7,
            'idTeam' => 3,
            'name' => 'NombreMem1T3',
            'lastname' => 'ApMem1T3',
            'email' => 'NombreMem1T3@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 8,
            'idTeam' => 3,
            'name' => 'NombreMem2T3',
            'lastname' => 'ApMem2T3',
            'email' => 'NombreMem2T3@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 9,
            'idTeam' => 3,
            'name' => 'NombreMem3T3',
            'lastname' => 'ApMem3T3',
            'email' => 'NombreMem3T3@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);

        // Miembros team4
        DB::table('members')->insert([
            'id' => 10,
            'idTeam' => 4,
            'name' => 'NombreMem1T4',
            'lastname' => 'ApMem1T4',
            'email' => 'NombreMem1T4@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 11,
            'idTeam' => 4,
            'name' => 'NombreMem2T4',
            'lastname' => 'ApMem2T4',
            'email' => 'NombreMem2T4@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
        DB::table('members')->insert([
            'id' => 12,
            'idTeam' => 4,
            'name' => 'NombreMem3T4',
            'lastname' => 'ApMem3T4',
            'email' => 'NombreMem3T4@ctf.com',
            'career' => 'Ingenieria de Sistemas',
            'university' => 'Universidad Privada Domingo Savio'
        ]);
    }
}
